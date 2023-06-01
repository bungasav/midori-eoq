<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'UserId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'EmailAddress',
        'RoleId',
        'Name',
        'Status',
        'PhoneNumber',
        "PasswordHash",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PasswordHash',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'createdDate' => 'CreatedDated',
        'email' => 'EmailAddress'
    ];
    public function role(): HasOne
    {
        return $this->hasOne(Role::class,'RoleId', 'RoleId');
    }
    public function getAuthPassword()
    {
        return $this->PasswordHash;
    }

    public function getEmailForVerification()
    {
        return $this->EmailAddress;
    }

}