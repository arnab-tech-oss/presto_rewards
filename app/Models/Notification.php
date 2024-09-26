<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Notification extends Model
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'id',
        'customer_id',
        'message',
        'date_time',
        'is_read',
        'created_at',
        'updated_at',
        'source',
        'notification_type',
        'user_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
    public function notifi(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    }
   
