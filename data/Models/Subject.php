<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable=['subjectName','description'];
    public $timestamps=false;
}
