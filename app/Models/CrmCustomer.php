<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CrmCustomer extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'crm_customers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'first_name',
        'gov',
        'address',
        'phone',
        'phone_2',
        'email',
        'website',
        'description',
        'cus_status_id',
        'due_amount',
        'paid_amount',
        'required_amount',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function csNameIncomes()
    {
        return $this->hasMany(Income::class, 'cs_name_id', 'id');
    }

    public function csExpensesExpenses()
    {
        return $this->hasMany(Expense::class, 'cs_expenses_id', 'id');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id', 'id');
    }

    public function cus_status()
    {
        return $this->belongsTo(CrmStatus::class, 'cus_status_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
