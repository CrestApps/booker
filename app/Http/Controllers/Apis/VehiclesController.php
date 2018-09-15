<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;

class VehiclesController extends Controller
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
    public function get($vehicleId)
    {
        $vehicle = Vehicle::with([
            'reservations' => function ($query) {
                return $query->where('status', 'scheduled');
            },
            'size',
            'brand',
        ])->find($vehicleId);

        if (!$vehicle) {
            return new ErrorResource('Unable to find the vehicle.');
        }

        return new VehicleResource($vehicle);
    }
}
