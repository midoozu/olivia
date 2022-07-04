<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEmployee extends Model
{

    protected $guarded = [];

    public function allowances()
    {
        return $this->hasMany(HrEmployeeAllowances::class, 'employee_id');
    }//en fun

    public function department()
    {
        return $this->belongsTo(HrDepartment::class);
    }
}
