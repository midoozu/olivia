<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrShiftsTimes extends Model
{

    protected $guarded = [];


    public function shift_rl()
    {
        return $this->belongsTo(HrShifts::class,'shift_id','id');
    }//end fun
    //
        public function department_rl()
    {
        return $this->belongsTo(HrDepartment::class,'department_id','id');
    }//end fun

}//end class
