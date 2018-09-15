<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationDropoffsFormRequest;
use App\Models\Check;
use App\Models\CreditPayment;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use DB;

class ReservationDropoffsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the reservations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $reservations = $this->getDropoffQuery()->paginate(25);

        return view('reservation_dropoffs.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return Illuminate\View\View
     */
    public function dropoff($id)
    {
        $reservation = $this->getDropoffQuery()
            ->with('creditRelation', 'primaryDriver.credit')
            ->findOrFail($id);

        $totalOpenCredit = $this->getCreditAmount($reservation);

        $totalDaysUsed = $this->getTotalDays($reservation->reserved_to);

        // 1) Here we need to figure out if the reservation is elgible for early dropoff
        //    if so, we need to allow the user to set how much the total resevation should be

        // 2) We need to figure out if there is an open credit associated with this account
        //    if so, we need to let the user know and allow them to capture a payment.

        return view('reservation_dropoffs.dropoff', compact('reservation', 'totalDaysUsed', 'totalOpenCredit'));
    }

    /**
     * Process the dropoff of the reservation.
     *
     * @param int $id
     * @param App\Http\Requests\ReservationPickupsFormRequestAbc $request
     *
     * @return Illuminate\View\View
     */
    public function process($id, ReservationDropoffsFormRequest $request)
    {
        $reservation = $this->getDropoffQuery()
            ->with('creditRelation', 'primaryDriver.credit')
            ->findOrFail($id);

        $data = $request->validated();
        DB::transaction(function () use ($reservation, $data) {
            $vehicle = Vehicle::findOrFail($reservation->vehicle_id);
            $vehicle->current_miles = $data['current_miles'];
            $vehicle->save();

            // Update the total days using today's date as the end date
            $today = Carbon::now()->endOfDay();
            $reservation->reserved_to = $today;
            $reservation->total_days = $reservation->reserved_from->diffInDays($today);
            $reservation->status = 'completed';
            $reservation->save();

            // Process payments
            if ($reservation->creditRelation && $reservation->primaryDriver->credit) {
                $payments = collect($data['payments']);
                $totalPayment = $this->sumPayments($payments);

                if ($totalPayment > $reservation->creditRelation->amount) {
                    throw new Exception('The total amount collected in more that the owed amount.');
                }

                foreach ($payments as $payment) {
                    $checkId = null;
                    if ($payment['method'] == 'check') {
                        $dueDate = Carbon::createFromFormat('j/n/Y', $payment['due_date']);
                        $check = Check::make($reservation->id, $reservation->primary_driver_id, $payment['amount'], $dueDate);
                        $check->save();
                        $checkId = $check->id;
                    }

                    $payment = CreditPayment::make($reservation->primaryDriver->credit->id, $payment['amount'], $payment['method'], $checkId);
                    $payment->save();
                    $reservation->primaryDriver->credit->amount -= $payment['amount'];
                    $reservation->primaryDriver->credit->save();
                }
            }
        });

        // At this point we need record payment againt the credit if any
        return redirect()->route('reservation_dropoffs.reservation_dropoff.index')
            ->with('success_message', trans('reservation.pickup_was_successful'));
    }

    /**
     * calulate the sum of the given payment by the given method
     *
     * @param Illuminate\Support\Collection $payments
     * @param string $method
     *
     * @return float
     */
    private function sumPayments($payments, $method = null)
    {
        $total = $payments->sum(function ($payment) use ($method) {
            if (empty($method)) {
                return $payment['amount'];
            }

            return (array_key_exists('method', $payment) && $payment['method'] == $method) ? $payment['amount'] : 0;
        });

        return $total;
    }

    /**
     * Find out the total days the reservation is early or late
     *
     * @param Carbon\Carbon $reservedTo
     *
     * @return int
     */
    private function getTotalDays($reservedTo)
    {
        $total = $reservedTo->diffInDays(Carbon::now());

        return $total;
    }

    /**
     * Get the base query builder for the pickable reservations
     *
     * @return Illuminate\Database\Eloquent\Builder builder
     **/
    private function getDropoffQuery()
    {
        $query = Reservation::with('primaryDriver', 'vehicle', 'additionalDrivers')
            ->where('status', 'in-progress');

        return $query;
    }

    /**
     * Get the amount of the credit that is associated with the given reservation
     *
     * @param App\Models\Reservation
     *
     * @return float
     */
    private function getCreditAmount(Reservation $reservation)
    {
        if (!$reservation->primaryDriver->credit) {
            return 0;
        }

        $totalReservationCredit = $reservation->primaryDriver->credit->amount;
        $totalCustomerCredit = optional($reservation->creditRelation)->amount;

        if ($totalCustomerCredit < $totalReservationCredit) {
            // At this point it is likly that the customer made a payment
            // before dropping this vehicle
            // the remaining balance is the $totalCustomerCredit instead
            return $totalCustomerCredit;
        }

        return $totalReservationCredit;
    }
}
