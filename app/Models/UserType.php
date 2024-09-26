<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    protected $fillable=[
        'roll_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class,'roll_id','id');
    }
}
