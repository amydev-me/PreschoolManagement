<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $fillable=['academicName','start_date','end_date','active_year'];
    protected $dates=['start_date','end_date'];
    public $timestamps=false;

}
