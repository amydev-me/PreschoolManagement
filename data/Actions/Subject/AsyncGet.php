<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:52 PM
 */

namespace Data\Actions\Subject;


class AsyncGet extends BaseSubjectAction
{
    protected function perform()
    {
        $data = $this->repository->asyncGetData();
        return $data;
    }
}