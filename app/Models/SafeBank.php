<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class SafeBank extends Model
{

	protected $guarded =[];

	public function getNameAttribute($value) {
        return $this->{'name_' . App::getLocale()};
    }

    public function tree(){
    	return $this->morphOne(TreeAccount::class,'tree_accountable');
    }


}
