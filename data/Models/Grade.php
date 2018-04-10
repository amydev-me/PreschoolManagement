<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['academic_id','category_id','gradeName', 'start_date', 'end_date','description'];
    public $timestamps=false;


    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);

    }

    public function grade_teachers(){
        return $this->hasMany(GradeTeacher::class);
    }

    public function terms()
    {
        return $this->belongsToMany(Term::class)->withPivot('term_id','grade_id','amount');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
