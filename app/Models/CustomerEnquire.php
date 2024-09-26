<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomerEnquire extends Model
{
    use HasFactory,Notifiable,HasApiTokens,SoftDeletes;

    protected $fillable = [
        'customer_id',
        'subject',
        'created_at',
        'updated_at',
        'deleted_at',
        'type',
        'ticket_no',
        'status',
        'reply_by',
        'product_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function convertation()
    {
        return $this->hasMany(Conversation::class,'ticket_no','ticket_no');
    }
}
