<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReservationPickupsFormRequest extends FormRequest
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
            'current_miles' => 'required|numeric|min:100',
            'payments' => 'required|array',
            'payments.*.method' => 'required|in:cash,bank_card,check,credit',
            'payments.*.amount' => 'required|numeric|min:0.01',
            'payments.*.due_date' => [
                'nullable',
                'date_format:j/n/Y',
                'required_if:payments.*.method,check',
                'required_if:payments.*.method,credit',
            ],
        ];

        return $rules;
    }
}
