<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeBonus extends Model
{
    protected $guarded = [];

    protected $table = 'hr_employee_bonus';

    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'employee_id');
    }
}
