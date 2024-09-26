<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasFactory,HasApiTokens,SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function product()
    {
        return $this->hasMany(Product::class,'categories_id','id');
    }
}
