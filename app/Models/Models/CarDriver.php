<?php

namespace App\Models\Models;

use App\Models\Carslist;
use App\Models\HR\HrEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    use HasFactory;
    public function car(){
        return $this->hasOne(Carslist::class,'id','car_id');
    }

    public function driver(){
        return $this->hasOne(HrEmployee::class,'id','driver_id');
    }
}
