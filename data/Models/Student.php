<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['academic_id', 'guardian_id', 'studentCode', 'profile', 'firstName', 'lastName', 'fullName', 'email',
        'dateofbirth', 'gender', 'phone', 'nrc', 'nationality', 'join_date', 'benefit',
        'meal_preferences', 'allergies', 'address', 'history'];
    protected $dates = ['dateofbirth'];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class);
    }

}