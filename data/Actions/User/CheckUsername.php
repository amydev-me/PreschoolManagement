<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:28 AM
 */

namespace Data\Actions\User;


class CheckUsername extends BaseUserAction
{
    protected function perform()
    {
        $user= $this->repository->checkUserName($this->request()['username']);
        if($user){
            return false;
        }
        return true;
    }
}