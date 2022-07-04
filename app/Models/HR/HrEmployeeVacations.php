<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeVacations extends Model
{

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'employee_id');
    }

    public function vacation()
    {
        return $this->belongsTo(HrVacations::class, 'vacation_id');
    }
}
