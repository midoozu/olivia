<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('appointment_create');
    }

    public function rules()
    {
        return [
            'client_id' => [
                'required',
                'integer',
            ],
            'doctor_id' => [
                'required',
                'integer',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],


            'comment' => [

                'string',
                'nullable',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'required',
                'array',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
            'pulse' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
