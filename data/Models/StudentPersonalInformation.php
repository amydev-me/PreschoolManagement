<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPersonalInformation extends Model
{
    protected $fillable=['student_id','fullName','otherName','dateofbirth','gender','placeofbirth','nationality','langhome','religion',];
    public $timestamps=false;
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
