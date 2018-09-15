<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => [
                'title' => trans('vehicles.name'),
                'value' => $this->name,
            ],
            'vin' => [
                'title' => trans('vehicles.vin_number'),
                'value' => $this->vin_number,
            ],
            'licence_plate' => [
                'title' => trans('vehicles.licence_plate'),
                'value' => $this->licence_plate,
            ],
            'size' => [
                'title' => trans('vehicle_sizes.size'),
                'value' => optional($this->size)->name,
            ],
            'brand' => [
                'title' => trans('brands.brand'),
                'value' => optional($this->brand)->name,
            ],
            'color' => [
                'title' => trans('vehicles.color'),
                'value' => $this->color,
            ],
            'daily_rate' => [
                'title' => trans('vehicles.daily_rate'),
                'value' => $this->daily_rate,
            ],
            'weekly_rate' => [
                'title' => trans('vehicles.weekly_rate'),
                'value' => $this->weekly_rate,
            ],
            'monthly_rate' => [
                'title' => trans('vehicles.monthly_rate'),
                'value' => $this->monthly_rate,
            ],
            'reservations' => [
                'title' => '',
                'value' => $this->getDailyReservations(),
            ],
        ];
    }

    /**
     * Returns other attributes to the request
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => 'success',
        ];
    }

    /**
     * Breaks the reservations to a daily level
     *
     * @return array
     */
    protected function getDailyReservations()
    {
        $days = [];
        foreach ($this->reservations as $reservation) {

            for ($day = $reservation->reserved_from; $day <= $reservation->reserved_to; $day->addDays(1)) {
                $days[] = $day->format("Y-m-d");
            }
        }

        return $days;
    }
}
