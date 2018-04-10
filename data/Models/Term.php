<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['academic_id','category_id','termName', 'start_date', 'end_date', 'due_date'];
    public $timestamps = false;
    protected $dates = ['start_date', 'end_date', 'due_date'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function academic()
    {
        return $this->belongsTo(Academic::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class)->withPivot('term_id','grade_id','amount');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
