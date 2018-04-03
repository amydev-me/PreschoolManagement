<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\Teacher;


class AsyncTeacher extends BaseTeacherAction
{


    protected function perform()
    {
       $teachers= $this->repository->asyncGetData($this->request()['fullName']);
       return $teachers;
    }
}