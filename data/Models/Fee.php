<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable=['feeName','description','amount'];
    public $timestamps=false;
}
