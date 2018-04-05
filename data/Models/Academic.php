<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $fillable=['academicName','active_year'];

    public $timestamps=false;
    public function grades(){
        return $this->hasMany(Grade::class);
    }

    public function grade_teachers(){
        return $this->hasMany(GradeTeacher::class);
    }
}
