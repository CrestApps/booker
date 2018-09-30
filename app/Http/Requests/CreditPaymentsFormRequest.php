<?php

namespace App\Http\Requests;

use Auth;
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
            'credit_id' => 'required|integer',
            'payment_method' => 'required|in:cash,bank_card,check',
            'amount' => 'required|numeric|min:0.01|max:9999999.999',
        ];

        if ($this->method() == 'POST') {
            $rules['due_date'] = 'nullable|date_format:j/n/Y|required_if:payment_method,check';
        }

        return $rules;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd($validator->failed());
    }
}
