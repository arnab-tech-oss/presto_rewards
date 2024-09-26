<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AppSetting extends Model
{
    use HasFactory,Notifiable,HasApiTokens;

    protected $fillable = [
        'customer_id',
        'whatsapp_availability',
        'last_login',
        'mobile_id',
        'app_version',
        'language',
        'notification_setting',
        'location_setting',
        'theme_preference',
        'apptour_status',
        'preffered_currancy',
        'biometric_auth',
        'mpin_auth',

    ];
}
