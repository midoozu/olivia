<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function servicesDoctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function servicesAppointments()
    {
        return $this->belongsToMany(Appointment::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
