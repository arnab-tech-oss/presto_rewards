<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'from',
        'to',
        'cc',
        'bcc',
        'subject',
        'body',
        'date',
        'headers',
        'attachments',
        'user_id',
        'created_at',
        'updated_at',
        'ref_no'
    ];
}
