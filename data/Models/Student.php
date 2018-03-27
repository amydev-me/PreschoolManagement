<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['course_id', 'batch_id', 'guardian_id', 'studentCode', 'profile', 'firstName', 'lastName', 'email',
        'dateofbirth', 'gender', 'phone', 'nrc', 'nationality', 'join_date', 'benefit',
        'meal_preferences', 'allergies', 'address', 'history'];
    protected $dates = ['dateofbirth'];
}