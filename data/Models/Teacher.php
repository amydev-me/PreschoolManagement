<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['teacherCode', 'profile', 'firstName', 'lastName', 'fullName', 'dateofbirth', 'gender',
        'phone', 'nrc', 'nationality', 'address', 'degree', 'benefit', 'position', 'salary', 'join_date',
        'contactFirstName', 'contactLastName', 'contactEmail', 'contactphone', 'contactrelation', 'biography', 'personal_email'];
    protected $dates = ['dateofbirth', 'join_date'];
    public function grade_teachers(){
        return $this->hasMany(GradeTeacher::class);
    }
}
