<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['academic_id', 'grade_id', 'studentCode', 'profile','join_date','fullName', 'otherName',
        'em_name', 'em_relation', 'em_contact', 'student_live'];
    protected $dates = ['dateofbirth'];

    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function student_personal_information(){
        return $this->hasOne(StudentPersonalInformation::class);
    }

    public function student_background(){
        return $this->hasOne(StudentBackground::class);
    }

    public function sibling_information(){
        return $this->hasOne(SiblingInformation::class);
    }

    public function student_medical(){
        return $this->hasOne(StudentMedical::class);
    }

    public function student_guardian(){
        return $this->hasOne(StudentGuardian::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function attendances(){
        return $this->hasMany(Attendance::class);
    }
}