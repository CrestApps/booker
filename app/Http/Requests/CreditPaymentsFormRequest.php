<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreditPaymentsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'credit_id' => 'required',
            'amount' => 'required|numeric|min:-9999999.999|max:9999999.999',
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
        $data = $this->only(['credit_id', 'amount']);



        return $data;
    }

}