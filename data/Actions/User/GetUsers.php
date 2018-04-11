<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:28 AM
 */

namespace Data\Actions\User;


class GetUsers extends BaseUserAction
{
    protected function perform()
    {

        return $this->repository->getUserByRole('admin', $this->pages);

    }
}