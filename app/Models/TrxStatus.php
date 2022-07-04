<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxStatus extends Model
{
    use SoftDeletes, Auditable;
    public $table = 'trx_status';


    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
