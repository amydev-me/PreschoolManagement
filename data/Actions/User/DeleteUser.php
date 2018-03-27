<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:33 AM
 */

namespace Data\Actions\User;


class DeleteUser extends BaseUserAction
{
    protected function perform()
    {
        $admin = $this->repository->delete($this->request());
        if ($admin) {
            return true;
        }
        return false;
    }
}