<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTimeRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'site_id',
        'days_present',
        'total_ot',
        'attendance_from',
        'attendance_to',
        'created_at',
        'updated_at',
    ];

    public $table = 'employee_time_records';
}
