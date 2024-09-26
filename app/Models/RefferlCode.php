<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class RefferlCode extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens,Notifiable;

    protected $fillable = [
        'code',
        'customer_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
