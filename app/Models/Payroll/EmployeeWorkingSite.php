<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeWorkingSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_information_id',
        'working_site_id',
        'job_title',
        'total_ot',
        'job_title_rate',
        'created_at',
        'updated_at',
    ];

    public $table = 'employee_working_sites';
}
