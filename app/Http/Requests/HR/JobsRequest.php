<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class JobsRequest extends FormRequest
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
            //
            'title'         => 'required',
            'max_salary'    => 'required|numeric',
            'min_salary'    => 'required|numeric',
            'department_id' => 'required'
        ];
    }
    

}
