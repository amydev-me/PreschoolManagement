<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class SiblingInformation extends Model
{
    protected $fillable=['student_id','sb_one_name','sb_one_gender','sb_one_dob','sb_one_school','sb_two_name','sb_two_gender','sb_two_dob','sb_two_school','sb_three_name','sb_three_gender','sb_three_dob','sb_three_school'];
    public $timestamps=false;
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
