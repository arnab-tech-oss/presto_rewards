<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'software_title',
        'software_description',
        'software_version',
        'company_name',
        'company_logo',
        'company_intro',
        'company_email',
        'company_alternative_email',
        'company_contact_no',
        'company_alternative_contact_no',
        'company_gst_no',
        'billing_header',
        'billing_footer',
        'billing_footer1',
        'user_id',
        'email_cc',
        'email_bcc',
        'api_key',
        'created_at',
        'updated_at'
    ];
}
