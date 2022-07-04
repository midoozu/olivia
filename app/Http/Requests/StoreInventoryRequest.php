<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInventoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('inventory_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
