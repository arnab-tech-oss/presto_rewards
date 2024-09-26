<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class BankAccount extends Model
{
    use HasFactory,HasApiTokens,Notifiable;

    protected $fillable = [
        'customer_id',
        'bank_name',
        'account_number',
        'bank_ifsc',
    ];
}
