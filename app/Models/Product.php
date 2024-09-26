<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProductCatalog;
use App\Models\ProductReviews;

class Product extends Model
{
    use HasFactory, HasApiTokens, SoftDeletes, Notifiable;

    // public $fillable = ['product_name'];

    protected $fillable = [
        'product_name',
        'description',
        'price_range',
        'status',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'categories_id',
        'brand_id',
        'product_code',
        'catalogs_id'
    ];

    public function catagory()
    {
        return $this->belongsTo(Catalog::class, 'catalogs_id', 'id');
    }
    public function productview()
    {
        return $this->hasone(ProductReviews::class,);
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id','id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'brand_id','id');
    }
}
