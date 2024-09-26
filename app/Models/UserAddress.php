<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class UserAddress extends Model
{
    use HasFactory,Notifiable,SoftDeletes;

    protected $fillable= [
        'user_id',
        'address_1',
        'address_2',
        'state',
        'district',
        'postal_code',
    ];
}
