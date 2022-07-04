<?php

namespace App\Http\Requests;

use App\Models\CrmCustomer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCrmCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('crm_customer_edit');
    }

    public function rules()
    {
        return [
            'first_name' => [
                'string',
                'required',
                'unique:crm_customers,first_name,' . request()->route('crm_customer')->id,
            ],
            'gov' => [
                'string',
                'required',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'required',
                'unique:crm_customers,phone,' . request()->route('crm_customer')->id,
            ],
            'phone_2' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
        ];
    }
}
