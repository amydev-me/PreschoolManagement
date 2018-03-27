<?php

namespace Data\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password','type','access_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
