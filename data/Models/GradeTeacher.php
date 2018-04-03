<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class GradeTeacher extends Model
{
    protected $fillable = ['academic_id', 'grade_id', 'teacher_id','subject_id'];
    public $timestamps=false;
    public function academic()
    {
        return $this->belongsTo(Academic::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
