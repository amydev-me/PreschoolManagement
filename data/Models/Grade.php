<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['academic_id','category_id','gradeName', 'start_date', 'end_date','description'];
    public $timestamps=false;

    public function terms(){
        return $this->hasMany(Term::class);
    }

    public function academic(){
        return $this->belongsTo(Academic::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);

    }
}
