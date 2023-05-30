<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ROP extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'view_rop';
    //protected $primaryKey = 'Name';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Name',
        'OrderCount',
        'X',
        'Y',
        "X-Y",
        "safety_stock",
        "LQ",
        "ROP"
    ];
}