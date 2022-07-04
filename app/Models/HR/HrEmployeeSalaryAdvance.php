<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeSalaryAdvance extends Model
{

    protected $guarded = [];

    protected $table = 'hr_employee_salary_advance';

    public function employee()
    {
        return $this->belongsTo(Hremployee::class, 'employee_id', 'id');
    }

     ////////////////////////////???????? //////////////////////
    public function employee_rl()
    {
        return $this->belongsTo(HrEmployee::class,'employee_id');
    }


    ////////////////////////////???????? //////////////////////
    public function details_rl()
    {
        return $this->hasMany(HrEmployeeSalaryAdvanceInstallment::class
            ,'salary_advance_id','id');
    }
}
