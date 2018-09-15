<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReservationsFormRequest extends FormRequest
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
            'primary_driver_id' => 'required|integer|min:1',
            'vehicle_id' => 'required|integer|min:1',
            'reserved_from' => 'required|date_format:j/n/Y',
            'reserved_to' => 'required|date_format:j/n/Y',
            'total_override' => 'nullable|numeric|min:-9999999.999|max:9999999.999',
        ];

        return $rules;
    }
}
