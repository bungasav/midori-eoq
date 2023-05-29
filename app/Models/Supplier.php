<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Supplier extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'supplier';
    protected $primaryKey = 'SupplierId';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'SupplierId',
        'Name',
        'Address',
        'PhoneNumber',
        "BankName",
        "AccountName",
        "AccountNumber",
        "Status",
        "createdDate",
        "CreatedBy"
    ];
}