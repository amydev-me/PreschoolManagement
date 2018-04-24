<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected  $fillable=['student_id','grade_id','term_id','attendance_day','attendance_month','status','attend_date','remark'];
    public $timestamps=false;

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
