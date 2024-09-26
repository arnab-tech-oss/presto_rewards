<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Catelog2 extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes, Notifiable;

    protected $table = 'catalogs';
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'cover_picture'
    ];
}
