<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    protected $fillable=['student_id','g_one_name','g_one_relation','g_one_email','g_one_occupation','g_one_address','g_one_mobile','g_one_home','g_one_work',
        'g_two_name','g_two_relation','g_two_email','g_two_occupation','g_two_address','g_two_mobile','g_two_home','g_two_work'];
    public $timestamps=false;
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
