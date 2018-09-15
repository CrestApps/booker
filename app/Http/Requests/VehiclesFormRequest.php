<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class VehiclesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|nullable|string|min:1|max:255',
            'size_id' => 'required',
            'brand_id' => 'required',
            'model' => 'nullable|string|min:0|max:255',
            'year' => 'nullable|numeric|min:-32768|max:32767',
            'color' => 'nullable|string|min:0',
            'last_oil_change' => 'required|date_format:j/n/Y g:i A',
            'miles_to_oil_change' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'current_miles' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'registration_experation_on' => 'required|date_format:j/n/Y g:i A',
            'insurance_experation_on' => 'required|date_format:j/n/Y g:i A',
            'daily_rate' => 'required|numeric|min:0|max:9999999.999',
            'weekly_rate' => 'required|numeric|min:0|max:9999999.999',
            'monthly_rate' => 'required|numeric|min:0|max:9999999.999',
            'is_active' => 'boolean',
            'vin_number' => 'required|string|min:1|max:60',
            'licence_plate' => 'required|string|min:1|max:30',
            'purchase_cost' => 'nullable|numeric|min:-9999999.999|max:9999999.999',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['name', 'size_id', 'brand_id', 'model', 'year', 'color', 'last_oil_change', 'miles_to_oil_change', 'current_miles', 'registration_experation_on', 'insurance_experation_on', 'daily_rate', 'weekly_rate', 'monthly_rate', 'is_active', 'vin_number', 'licence_plate', 'purchase_cost']);

        $data['is_active'] = $this->has('is_active');


        return $data;
    }

}