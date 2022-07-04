<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrJobs extends Model
{

    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(HrDepartment::class, 'department_id', 'id');
    }
}
