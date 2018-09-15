<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
//use App\Http\Requests\CustomersFormRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomersResource;
use App\Http\Resources\ErrorJsonpResource;
use App\Http\Resources\ErrorResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    /**
     * Display the specified reservation.
     *
     * @param int $vehicleId
     *
     * @return App\Resources\VehicleResources
     */
    public function find($term)
    {
        $searchFor = trim($term, " \t\n\r\0\x0B%");

        if (!isset($searchFor[2])) {
            return new ErrorJsonpResource('Search term must be at least 3 charecters in length.');
        }

        $customers = Customer::where('fullname', 'like', $searchFor . '%')->get();

        return new CustomersResource($customers);
    }

    /**
     * Store a new customer in the storage.
     *
     * @param App\Http\Requests\CustomersFormRequest $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'fullname' => 'required|string|min:1|max:255',
                'home_address' => 'nullable|string|min:0|max:500',
                'personal_identification_number' => 'required|string|min:1|max:30',
                'driver_license_number' => 'required|string|min:1|max:30',
                'birth_date' => 'required|date_format:j/n/Y',
                'driver_license_issue_date' => 'required|date_format:j/n/Y',
                'driver_license_experation_date' => 'required|date_format:j/n/Y',
                'phone' => 'required|string|min:1|max:30',
            ]);

            $customer = Customer::create($data);

            return new CustomerResource($customer);
        } catch (Exception $exception) {

            return new ErrorResource($exception->getMessage());
        }
    }
}
