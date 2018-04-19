<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class StudentBackground extends Model
{
    protected $fillable=['student_id','previous_one','one_date','one_file','previous_two','two_date','two_file',];
    public $timestamps=false;

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
