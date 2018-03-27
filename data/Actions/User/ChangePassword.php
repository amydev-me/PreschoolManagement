<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:33 AM
 */

namespace Data\Actions\User;


class ChangePassword extends BaseUserAction
{
    protected function perform()
    {
        $admin = $this->request();

        $admin['password'] = $this->cryptPassword();

        $admin = $this->repository->update($admin, $admin['id']);
        if ($admin) {
            return true;
        }
        return false;
    }
}