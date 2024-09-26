<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media_file extends Model
{
    use HasFactory;
    protected $fillable = [
        'media_1',
        'media_2',
        'media_3',
        'slider_4',
    ];

    // public function getWelcomeScreenAttribute()
    // {
    //     return $this->attributes['media_1'];
    // }
}
