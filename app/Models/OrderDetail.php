<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class OrderDetail extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'orderdetail';
    protected $primaryKey = 'OrderDetailId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'OrderDetailId',
        'OrderId',
        'ItemId',
        'Quantity',
        "Status"
    ];
}