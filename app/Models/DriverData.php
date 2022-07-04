<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class DriverData extends Model
{
    use SoftDeletes;

    public $table = 'driver_datas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'driver_no',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function driverNameReceiptdeliveries()
    {
        return $this->hasMany(Receiptdelivery::class, 'driver_name_id', 'id');
    }
}
