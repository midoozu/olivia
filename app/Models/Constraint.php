<?php

namespace App\Models;

use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Illuminate\Database\Eloquent\Model;

class Constraint extends Model
{
    protected $guarded = [];

    public function contain_details()
    {
        return $this->hasMany(ConstraintDetail::class,'constraint_id');
    }


}//end class
