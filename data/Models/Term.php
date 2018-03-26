<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable=['grade_id','termName','start_date','end_date','term_type','term_time','time_type','amount'];
    public $timestamps=false;

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
}
