<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CatalogProduct extends Model
{
    use HasFactory,Notifiable,SoftDeletes,HasApiTokens;

    protected $fillable = [
        'catalog_id',
        'product_id',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class,);
    }
}
