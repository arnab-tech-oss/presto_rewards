<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Offer extends Model
{
    use HasFactory,HasApiTokens,Notifiable,SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'baner',
        'status',
        'duration',
        'cta',
        'created_by',
        'updated_by',
        'deleted_by',
        'big_image',
        'role_id'
    ];
}
