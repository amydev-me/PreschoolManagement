<?php

namespace Data\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['categoryName'];

    public $timestamps=false;

    public function grades(){
        return $this->hasMany(Grade::class);
    }
}
