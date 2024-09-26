<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Catalog extends Model
{
    use HasFactory,HasApiTokens,SoftDeletes,Notifiable;

    protected $fillable = [
        'name',
        'description',
        'image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function product()
    {
        return $this->hasMany(Product::class,'catalogs_id','id');
    }
}
