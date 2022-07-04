<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEmployeeSonction extends Model
{

    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(HrEmployee::class, 'employee_id');
    }

    public function sanction()
    {
        return $this->belongsTo(HrSonction::class, 'sonction_id');
    }
}
