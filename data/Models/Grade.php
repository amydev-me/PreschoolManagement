<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['academic_id','category_id','gradeName', 'start_date', 'end_date','description'];
    public $timestamps=false;
}
