<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'production';
    protected $primaryKey = 'ProductionId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ProductionId',
        'Reference',
        'CreatedDate',
        'UserId'
    ];
}