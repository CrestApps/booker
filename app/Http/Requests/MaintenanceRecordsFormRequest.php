<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

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
            'vehicle_id' => 'required|integer|min:1',
            'category_id' => 'required|integer|min:1',
            'payment_method' => 'string|in:checks,cash',
            'cost' => 'required|numeric|min:-9999999.999|max:9999999.999',
            'checks' => 'required_if:payment_method,checks|array',
            'checks.*.id' => 'nullable|integer|min:1|max:9999999',
            'checks.*.number' => 'nullable|required_if:payment_method,checks|integer|min:1|max:9999999',
            'checks.*.value' => 'nullable|required_if:payment_method,checks|numeric|min:1|max:9999999.999',
            'checks.*.due_date' => 'nullable|required_if:payment_method,checks|date_format:j/n/Y',
            'paid_at' => 'required|date_format:j/n/Y',
            'related_date' => 'required|date_format:j/n/Y',
            'notes' => 'nullable|string|min:0|max:1000',
        ];

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
