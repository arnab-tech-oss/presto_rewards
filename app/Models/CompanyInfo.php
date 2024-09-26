<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'company_name',
        'address',
        'city',
        'state',
        'country_name',
        'phone',
        'email',
        'gst_number',
        'company_header',
        'company_logo',
        'created_at',
        'updated_at',
        'whats_app_no'
    ];
}
