<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public const PERMISSION_CODE = 'PP';

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * Check if user is a Payroll personnel
     * 
     * @return boolean
     */
    public function isPayrollPersonnel(?string $roleCode = null): bool
    {
        return $this->roles->contains('role_code', $roleCode);
    }

    public function userRole(?string $roleCode = null): string
    {
        return $this->roles->where('role_code', $roleCode)->first()->role_description;
    }

    public function getFirstName(): string
    {
        return Str::ucfirst(Str::lower($this->first_name));
    }
    
    public function getLastName(): string
    {
        return Str::ucfirst(Str::lower($this->last_name));
    }

    public function getUserFullName(): string
    {
        return "{$this->getFirstName()} {$this->getLastName()}";
    }
}
