<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSanctionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sonction_id' => 'required',
            'employee_id' => 'required',
            'month'       => 'required',
            'value'       => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'value.numeric' => 'القيمة يجب أن تكون أرقام فقط'
        ];
    }
}
