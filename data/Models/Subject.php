<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['subjectName','description'];
    public $timestamps=false;

    public function grade_teachers(){
        return $this->hasMany(GradeTeacher::class);
    }
}
