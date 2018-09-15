<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'id' => $this->id,
            'fullname' => $this->fullname,
            'phone' => $this->phone,
            'home_address' => $this->home_address,
            'personal_identification_number' => $this->personal_identification_number,
            'driver_license_number' => $this->driver_license_number,
            'birth_date' => $this->birth_date->format(config('app.date_out_format')),
            'driver_license_issue_date' => $this->driver_license_issue_date->format(config('app.date_out_format')),
            'driver_license_experation_date' => $this->driver_license_experation_date->format(config('app.date_out_format')),
            'is_black_listed' => $this->is_black_listed,
            'black_list_notes' => $this->black_list_notes,
            'home_address' => $this->home_address,
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
}
