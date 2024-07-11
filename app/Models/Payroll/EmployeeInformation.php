<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payroll\EmployeeTimeRecord;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * get the days present from the employee time records
     */
    public function daysPresent(): HasMany
    {
        return $this->hasMany(EmployeeTimeRecord::class, 'employee_id');
    }
}
