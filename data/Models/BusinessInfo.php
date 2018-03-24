<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    protected $fillable=['title','phone','address','email','fax','footer','note','logo','login_text','academic_id'];
}
