<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CreditsFormRequest extends FormRequest
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
            'customer_id' => 'required',
            'amount' => 'required|numeric|min:-9999999.999|max:9999999.999',
            'due_date' => 'required|date_format:j/n/Y',
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
        $data = $this->only(['customer_id', 'amount', 'due_date']);



        return $data;
    }

}