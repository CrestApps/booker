<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ExpensesFormRequest extends FormRequest
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
            'category_id' => 'required',
            'related_date' => 'required|date_format:n/Y|date_format:j/n/Y',
            'amount' => 'required|numeric|min:-9999999.999|max:9999999.999',
            'pay_date' => 'required|date_format:j/n/Y',
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
        $data = $this->only(['category_id', 'related_date', 'amount', 'pay_date', 'notes']);



        return $data;
    }

}