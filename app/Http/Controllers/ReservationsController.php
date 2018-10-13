<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationsFormRequest;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\ReservationToDriver;
use App\Models\Vehicle;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{

    /**
     * Display a listing of the reservations.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $reservations = Reservation::with('primarydriver', 'vehicle')
            ->order()
            ->paginate(25);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $primaryDrivers = Customer::pluck('fullname', 'id')->all();
        $vehicles = Vehicle::pluck('name', 'id')->all();

        return view('reservations.create', compact('primaryDrivers', 'vehicles'));
    }

    /**
     * Store a new reservation in the storage.
     *
     * @param App\Http\Requests\ReservationsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ReservationsFormRequest $request)
    {
        try {
            $data = $request->validated();
            DB::transaction(function () use ($data) {

                $from = Carbon::createFromFormat(config('app.date_out_format'), $data['reserved_from']);
                $to = Carbon::createFromFormat(config('app.date_out_format'), $data['reserved_to']);
                $totalDays = $from->diffInDays($to) ?: 1;
                $vehicle = Vehicle::findOrFail($data['vehicle_id']);
                $rate = $vehicle->getRate($totalDays);
                $totalRent = $rate * $totalDays + doubleval($data['total_override']);

                $reservation = Reservation::whipOut($from, $to, $data['primary_driver_id'], $data['vehicle_id'], $data['total_override'], $totalDays, $totalRent);

                $reservation->save();

                if (isset($data['additional_drivers'][0])) {
                    // At this point we know there are at least one additional driver
                    foreach ($data['additional_drivers'] as $driverId) {
                        $additionalDriver = ReservationToDriver::whipOut($reservation->id, $driverId);
                        $additionalDriver->save();
                    }
                }
            }, 3);

            return redirect()->route('reservations.reservation.index')
                ->with('success_message', trans('reservations.model_was_added'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('reservations.unexpected_error') . ' ' . $exception->getMessage()]);
        }
    }

    /**
     * Display the specified reservation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $reservation = Reservation::with('primarydriver', 'vehicle', 'additionalDrivers')->findOrFail($id);

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $primaryDrivers = Customer::pluck('fullname', 'id')->all();
        $vehicles = Vehicle::pluck('name', 'id')->all();

        return view('reservations.edit', compact('reservation', 'primaryDrivers', 'vehicles'));
    }

    /**
     * Update the specified reservation in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ReservationsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ReservationsFormRequest $request)
    {
        try {
            $data = $request->validated();

            $from = Carbon::createFromFormat(config('app.date_out_format'), $data['reserved_from']);
            $to = Carbon::createFromFormat(config('app.date_out_format'), $data['reserved_to']);
            $data['total_days'] = $from->diffInDays($to) ?: 1;

            $reservation = Reservation::findOrFail($id);

            if ($data['total_rent'] != $reservation['total_rent']) {
                $data['total_tax'] = $data['total_rent'] * config('booker.tax_rate', 0);
            }

            $reservation->update($data);

            return redirect()->route('reservations.reservation.index')
                ->with('success_message', trans('reservations.model_was_updated'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('reservations.unexpected_error')]);
        }
    }

    /**
     * Remove the specified reservation from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return redirect()->route('reservations.reservation.index')
                ->with('success_message', trans('reservations.model_was_deleted'));
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => trans('reservations.unexpected_error')]);
        }
    }
}
