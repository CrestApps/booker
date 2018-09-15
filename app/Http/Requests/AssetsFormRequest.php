<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AssetsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:255',
            'category_id' => 'required',
            'cost' => 'required|numeric|min:-9999999.999|max:9999999.999',
            'purchased_at' => 'required|date_format:j/n/Y g:i A',
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
        $data = $this->only(['name', 'category_id', 'cost', 'purchased_at', 'notes']);



        return $data;
    }

}