<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'created_at',
        'updated_at',
    ];

    public $table = 'working_sites';
}
