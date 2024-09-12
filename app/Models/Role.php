<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_code',
        'role_description',
    ];


    /* public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles');
    } */
}
