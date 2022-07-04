<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Doctor_Percentage extends Model
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'Doctor_Percentage';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'doctor_id',
        'service_id',
        'Percentage',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
