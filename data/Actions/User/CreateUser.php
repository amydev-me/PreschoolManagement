<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:28 AM
 */

namespace Data\Actions\User;


class CreateUser extends BaseUserAction
{
    protected function perform()
    {
        $admin = $this->request();
        $admin['password'] = $this->cryptPassword();
        $admin = $this->repository->create($admin);
        if ($admin) {
            return true;
        }
        return false;
    }
}