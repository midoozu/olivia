<?php

namespace App\Http\Requests\HR;

use Illuminate\Foundation\Http\FormRequest;

class AdvancesRequest extends FormRequest
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
            'employee_id'       => 'required',
            'value'             => 'required',
            'one_month_amount'  => 'required|lte:'.$this->value,
            'month'             => 'required'
            
        ];
    }
    
    public function messages()
    {
        return [
            'one_month_amount.lte' => 'يجب أن تكون قيمة  القسط الواحد مساوية أو أصغر من :value.',
        ];
    }
}
