<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PayableChecksFormRequest extends FormRequest
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
            'number' => 'nullable|numeric|min:0|max:4294967295',
            'value' => 'required|numeric|min:1|max:9999999.999',
            'due_date' => 'required|date_format:j/n/Y',
            'issue_date' => 'required|date_format:j/n/Y',
            'is_cashed' => 'boolean',
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
        $data = $this->only(['number', 'value', 'due_date', 'issue_date', 'is_cashed']);

        $data['is_cashed'] = $this->has('is_cashed');


        return $data;
    }

}