<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_uuid',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'address',
        'contact_number',
        'employment_date',
        'created_at',
        'updated_at',
    ];

    public $table = 'employee_information';
}
