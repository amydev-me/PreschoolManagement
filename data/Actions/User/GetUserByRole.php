<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:42 AM
 */

namespace Data\Actions\User;


class GetUserByRole extends BaseUserAction
{
    protected function perform()
    {
        return   $this->repository->getUserByRole($this->pages);
    }
}