<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Item extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'item';
    protected $primaryKey = 'ItemId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ItemId',
        'Name',
        'SupplierId',
        'UserId',
        "Description",
        "UnitInStock",
        "UnitOfMeasurement",
        "Status",
        "CreatedDate"
    ];
}