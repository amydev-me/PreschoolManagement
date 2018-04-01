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

    public function scopeGetByCategory($query,$category_id){
        return $query->whereHas('terms.grade',function($q) use($category_id){
            $q->where('category_id',$category_id);
        });
    }

    public function scopeGetByGrade($query,$grade_id){
        return $query->whereHas('terms',function($q) use($grade_id){
            $q->where('grade_id',$grade_id);
        });
    }
}