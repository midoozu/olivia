<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class EmployeesRequest extends FormRequest
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
            'name'      => 'required',
            'phone'     => 'required',
            'email'     => 'required',
            'department_id' => 'required',
            'job_id'   => 'required',
            'salary'    => 'required|numeric',
        ];
    }
}
