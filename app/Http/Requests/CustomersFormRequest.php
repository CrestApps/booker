<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CustomersFormRequest extends FormRequest
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
        $method = $this->method();
        $rules = [];
        if ($method == 'POST') {
            $rules = [
                'fullname' => 'required|string|min:1|max:255',
                'home_address' => 'nullable|string|min:0|max:500',
                'personal_identification_number' => 'required|string|min:1|max:30',
                'driver_license_number' => 'required|string|min:1|max:30',
                'birth_date' => 'required|date_format:j/n/Y',
                'driver_license_issue_date' => 'required|date_format:j/n/Y',
                'driver_license_experation_date' => 'required|date_format:j/n/Y',
                'phone' => 'required|string|min:1|max:30',
            ];
        } else if ($method == 'PUT' || $method == 'PATCH') {
            $rules = [
                'fullname' => 'required|string|min:1|max:255',
                'home_address' => 'nullable|string|min:0|max:500',
                'personal_identification_number' => 'required|string|min:1|max:30',
                'driver_license_number' => 'required|string|min:1|max:30',
                'birth_date' => 'required|date_format:j/n/Y',
                'driver_license_issue_date' => 'required|date_format:j/n/Y',
                'driver_license_experation_date' => 'required|date_format:j/n/Y',
                'phone' => 'required|string|min:1|max:30',
                'is_black_listed' => 'boolean',
                'black_list_notes' => 'nullable|string|min:0|max:1000',
            ];
        }

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
        $data = $this->only(['fullname', 'home_address', 'personal_identification_number', 'driver_license_number', 'birth_date', 'driver_license_issue_date', 'driver_license_experation_date', 'phone', 'is_black_listed', 'black_list_notes']);

        $data['is_black_listed'] = $this->has('is_black_listed');

        return $data;
    }

}
