<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $fillable = ['academicName', 'active_year'];
    protected $appends = ['studentCount','income'];
    public $timestamps = false;

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function grade_teachers()
    {
        return $this->hasMany(GradeTeacher::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function getStudentCountAttribute()
    {
        return $this->students()->where('academic_id', $this->id)->count();
    }

    public function getIncomeAttribute()
    {
       $grades= $this->grades()->pluck('id');
       if($grades){
           $totalincome= Payment::whereIn('grade_id',$grades)->sum('total');
           return $totalincome;
       }
        return 0;
    }
}
