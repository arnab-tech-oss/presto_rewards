<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasFactory,HasApiTokens,SoftDeletes,Notifiable;

    protected $fillable =[
        'company_name',
        'brand_title',
        'company_address',
        'bank_name',
        'bank_acc_number',
        'bank_ifsc',
        'gstin',
        'logo',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
