<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class HrEvaluation extends Model
{

    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsTo(HrJobs::class, 'job_id');
    }
}
