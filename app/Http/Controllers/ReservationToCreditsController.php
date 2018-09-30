<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationToCreditsFormRequest;
use App\Models\Credit;
use App\Models\Reservation;
use App\Models\ReservationToCredit;
use Exception;

class ReservationToCreditsController extends Controller
{

    /**
     * Display a listing of the reservation to credits.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $reservationToCredits = ReservationToCredit::with('credit', 'reservation')->paginate(25);

        return view('reservation_to_credits.index', compact('reservationToCredits'));
    }

    /**
     * Show the form for creating a new reservation to credit.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $credits = Credit::pluck('created_at', 'id')->all();
        $reservations = Reservation::pluck('created_at', 'id')->all();

        return view('reservation_to_credits.create', compact('credits', 'reservations'));
    }

    /**
     * Store a new reservation to credit in the storage.
     *
     * @param App\Http\Requests\ReservationToCreditsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(ReservationToCreditsFormRequest $request)
    {
        try {

            $data = $request->getData();

            ReservationToCredit::create($data);

            return redirect()->route('reservation_to_credits.reservation_to_credit.index')
                ->with('success_message', 'Reservation To Credit was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified reservation to credit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $reservationToCredit = ReservationToCredit::with('credit', 'reservation')->findOrFail($id);

        return view('reservation_to_credits.show', compact('reservationToCredit'));
    }

    /**
     * Show the form for editing the specified reservation to credit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $reservationToCredit = ReservationToCredit::findOrFail($id);
        $credits = Credit::pluck('created_at', 'id')->all();
        $reservations = Reservation::pluck('created_at', 'id')->all();

        return view('reservation_to_credits.edit', compact('reservationToCredit', 'credits', 'reservations'));
    }

    /**
     * Update the specified reservation to credit in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\ReservationToCreditsFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, ReservationToCreditsFormRequest $request)
    {
        try {

            $data = $request->getData();

            $reservationToCredit = ReservationToCredit::findOrFail($id);
            $reservationToCredit->update($data);

            return redirect()->route('reservation_to_credits.reservation_to_credit.index')
                ->with('success_message', 'Reservation To Credit was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Remove the specified reservation to credit from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $reservationToCredit = ReservationToCredit::findOrFail($id);
            $reservationToCredit->delete();

            return redirect()->route('reservation_to_credits.reservation_to_credit.index')
                ->with('success_message', 'Reservation To Credit was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

}
