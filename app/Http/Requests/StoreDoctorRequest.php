<?php

namespace App\Http\Requests;

use App\Models\Doctor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('doctor_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'email' => [
                'required',
            ],
            'phone' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
            'min_amount' => [
                'required',
            ],
        ];
    }
}
