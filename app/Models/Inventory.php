<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'inventories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function invNameProducts()
    {
        return $this->hasMany(Product::class, 'inv_name_id', 'id');
    }

    public function branchUsers()
    {
        return $this->hasMany(User::class, 'branch_id', 'id');
    }

    public function branchExpenses()
    {
        return $this->hasMany(Expense::class, 'branch_id', 'id');
    }

    public function branchIncomes()
    {
        return $this->hasMany(Income::class, 'branch_id', 'id');
    }

    public function branchAppointments()
    {
        return $this->hasMany(Appointment::class, 'branch_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
