<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:52 PM
 */

namespace Data\Actions\FeeType;


class AsyncGet extends BaseFeeAction
{
    protected function perform()
    {
        $data = $this->repository->asyncGetData();
        return $data;
    }
}