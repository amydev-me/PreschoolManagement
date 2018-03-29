<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable=['grade_id','termName','start_date','end_date','term_type','term_time','time_type','amount'];
    public $timestamps=false;
    protected $hidden = ['pivot'];
    protected $appends=['gradeName'];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function getGradeNameAttribute()
    {
        return $this->grade()->value('gradeName');

    }
}
