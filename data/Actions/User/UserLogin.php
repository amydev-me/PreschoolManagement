<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:32 AM
 */

namespace Data\Actions\User;
use Data\Actions\Action;
use Illuminate\Support\Facades\Auth;


class UserLogin extends Action
{
    protected function perform()
    {
        $auth = (['username' => $this->request()['username'],
            'password' => $this->request()['password']]);
        if (!Auth::attempt($auth)) {
            return false;
        }
        Auth::login(Auth::user());
        return true;
    }
}