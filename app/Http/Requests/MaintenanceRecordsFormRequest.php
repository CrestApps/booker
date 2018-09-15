<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MaintenanceRecordsFormRequest extends FormRequest
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
            'vehicle_id' => 'required',
            'catgeory_id' => 'required',
            'cost' => 'nullable|numeric|min:-9999999.999|max:9999999.999',
            'paid_at' => 'required|date_format:j/n/Y g:i A',
            'related_date' => 'required|date_format:j/n/Y',
            'notes' => 'nullable|string|min:0|max:1000',
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
        $data = $this->only(['vehicle_id', 'catgeory_id', 'cost', 'paid_at', 'related_date', 'notes']);



        return $data;
    }

}