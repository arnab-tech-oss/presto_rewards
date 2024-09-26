<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class ProductReviews extends Model
{
    use HasFactory,SoftDeletes,Notifiable;

    protected $fillable = [
        'scale',
        'reviewtext',
        'customer_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'product_id',
    ];

    public function productreview()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
}
