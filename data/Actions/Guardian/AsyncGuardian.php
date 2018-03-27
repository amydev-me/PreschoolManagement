<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 10:38 PM
 */

namespace Data\Actions\Guardian;


class AsyncGuardian extends BaseGuardianAction
{
    protected function perform()
    {
        $data = $this->repository->asyncGetData($this->request['fullName']);
        return $data;
    }
}