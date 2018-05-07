<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    protected $fillable=['title','business_type','phone','address','email',
        'email_host',
        'email_port',
        'email_encryption',

        'email_subject','email_password','email_text','website','facebook','fax','footer','note','logo','invoice_logo','login_text','academic_id','instruction'];
}
