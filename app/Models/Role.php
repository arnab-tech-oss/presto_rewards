<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $fillable = [
        'role_name','description','created_by','updated_by','deleted_by'
    ];

    public function role()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function usertype()
    {
        return $this->hasMany(UserType::class,'roll_id','id');
    }
}
