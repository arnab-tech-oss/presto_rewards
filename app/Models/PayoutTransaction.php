<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'bank_ref',
        'amount',
        'status',
        'created_at',
        'updated_at',
        'payout_id',
        'transaction_no',
        'message',
        'bankrrn',
        'upitranlog_id',
        'seq_no',
        'mobileappdata',
        'response_code'
    ];
    public function payout(){
        return $this->belongsTo(Payout::class,'payout_id','id');
    }
}
