<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 11:22 PM
 */

namespace Data\Actions\Teacher;


class GetTeacherDetail extends BaseTeacherAction
{
    protected function perform()
    {
        $teacher = $this->repository->getDetail($this->request()['id']);
        return $teacher;
    }
}