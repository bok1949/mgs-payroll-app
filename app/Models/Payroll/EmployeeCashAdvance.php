<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCashAdvance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_information_id',
        'amount',
        'purpose',
        'cash_advanced_date',
        'created_at',
        'updated_at',
    ];

    public $table = 'employee_cash_advances';
}
