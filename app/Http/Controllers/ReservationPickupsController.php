<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationPickupsFormRequest;
use App\Models\Check;
use App\Models\Credit;
use App\Models\Reservation;
use App\Models\ReservationToCredit;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class ReservationPickupsController extends Controller
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
        $reservations = $this->getPickupQuery()->paginate(25);

        return view('reservation_pickups.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return Illuminate\View\View
     */
    public function pickup($id)
    {
        $reservation = $this->getPickupQuery()->findOrFail($id);

        return view('reservation_pickups.pickup', compact('reservation'));
    }

    /**
     * Process the pickup of the reservation.
     *
     * @param int $id
     * @param App\Http\Requests\ReservationPickupsFormRequestAbc $request
     *
     * @return Illuminate\View\View
     */
    public function process($id, ReservationPickupsFormRequest $request)
    {
        $reservation = $this->getPickupQuery()->findOrFail($id);
        $data = $request->validated();

        $payments = collect($data['payments']);

        // calulate the total from all payment methods
        $totalPayment = $this->sumPayments($payments);

        if ($reservation->total_rent > $totalPayment) {
            // At this point we know there is still an outstanding balance
            // reject the transaction
            return back()->withErrors(['error_message', trans('reservations.balance_should_be_0_before_continue')]);
        }

        $reservation->total_paid_in_cash = $this->sumPayments($payments, 'cash');
        $reservation->total_paid_in_bank_card = $this->sumPayments($payments, 'bank_card');
        $reservation->status = 'in-progress';
        $reservation->picked_up_at = Carbon::now();
        $reservation->mileage_started_at = $data['current_miles'];

        DB::transaction(function () use ($reservation, $payments) {
            $reservation->save();

            foreach ($payments as $payment) {
                if (!in_array($payment['method'], ['check', 'credit'])) {
                    continue;
                }

                $dueDate = Carbon::createFromFormat('j/n/Y', $payment['due_date']);

                if ($payment['method'] == 'check') {
                    $check = Check::whipOut($reservation->id, $reservation->primary_driver_id, $payment['amount'], $dueDate);
                    $check->save();

                    continue;
                }

                $credit = Credit::where('customer_id', $reservation->primary_driver_id)->first();

                if (!$credit) {
                    // At this point we need to create a new credit
                    $credit = Credit::whipOut($reservation->primary_driver_id, $payment['amount']);
                } else {
                    // We add the amount to the existsing credit;
                    $credit->amount += $payment['amount'];
                }

                $credit->save();

                // Add relation to the credit
                $creditRelation = ReservationToCredit::whipOut($reservation->id, $payment['amount'], $dueDate, $credit->id);
                $creditRelation->save();
            }
        }, 3);

        return redirect()->route('reservation_pickups.reservation_pickup.index')
            ->with('success_message', trans('reservations.pickup_was_successful'));
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
     * Show the reservation after completion/dropoff.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function processed($id)
    {
        $reservation = Reservation::with('primaryDriver')->findOrFail($id);

        if ($reservation->status != 'in-progress') {
            throw new Exception('The reservation is not yet completed');
        }
        return view('reservation_pickups.processed', compact('reservation'));
    }

    /**
     * Get the base query builder for the pickable reservations
     *
     * @return Illuminate\Database\Eloquent\Builder builder
     **/
    private function getPickupQuery()
    {
        $query = Reservation::with('primaryDriver', 'vehicle', 'additionalDrivers')
            ->where('status', 'scheduled')
            ->where('reserved_from', '<=', Carbon::now()->endOfDay());

        return $query;
    }
}
