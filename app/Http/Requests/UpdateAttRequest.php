<?php

namespace App\Http\Requests;

use App\Models\Att;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAttRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('att_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
