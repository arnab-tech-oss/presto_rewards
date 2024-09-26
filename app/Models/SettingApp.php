<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingApp extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'version',
        'applogo',
        'created_at',
        'updated_at',
        'beta_url',
        'playstore_url',
        'appstore_url',
        'dark_logo',
        'favicon_logo',
        'header',
        'footer_left',
        'footer_right',
        'cc',
        'Bcc'
    ];
}
