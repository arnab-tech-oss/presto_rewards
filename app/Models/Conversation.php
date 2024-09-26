<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Conversation extends Model
{
    use HasFactory,SoftDeletes,Notifiable;

    protected $fillable = [
        'created_at',
        'updated_at',
        'ticket_no',
        'message',
        'status',
        'reply_by',
        'deleted_at',
        'image'
    ];
    
}
