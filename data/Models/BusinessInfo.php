<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    protected $fillable=['title','phone','address','email','website','facebook','fax','footer','note','logo','invoice_logo','login_text','academic_id'];
}
