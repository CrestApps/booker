<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReservationDropoffsFormRequest extends FormRequest
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
            'updated_total_rent' => 'nullable|numeric|min:0',
            'payments' => 'nullable|array',
            'payments.*.method' => 'required|in:cash,bank_card,check',
            'payments.*.amount' => 'required|numeric|min:0.01',
            'payments.*.due_date' => [
                'nullable',
                'date_format:j/n/Y',
                'required_if:payments.*.method,check',
            ],
        ];

        return $rules;
    }
}
