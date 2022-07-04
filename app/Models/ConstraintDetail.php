<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstraintDetail extends Model
{
    protected $guarded = [];

    public function account_rl(){
        return $this->hasOne(Account::class,'id','account_id');
    }

    public function constraint_rl(){
        return $this->hasOne(Constraint::class,'id','constraint_id');
    }
}//end class
