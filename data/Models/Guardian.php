<?php

namespace Data\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = ['email', 'firstName', 'lastName', 'fullName', 'realation', 'occupation', 'phone', 'address'];


}
