<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CustomerAddress extends Model
{
    use HasFactory,Notifiable,SoftDeletes;

    protected $fillable = [
        'customer_id',
        'address_1',
        'address_2',
        'state_id',
        'postal_code',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

    public function customerstate()
    {
        return $this->belongsTo(State::class,'state_id','id');
    }

}
