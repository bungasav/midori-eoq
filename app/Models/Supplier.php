<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'supplier';
    protected $primaryKey = 'SupplierId';
    public $timestamps = false;
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