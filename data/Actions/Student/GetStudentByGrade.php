<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/04/2018
 * Time: 10:09 AM
 */

namespace Data\Actions\Student;


class GetStudentByGrade extends BaseStudentAction
{
    protected function perform()
    {
        return $this->repository->getStudentByGrade($this->request());
    }
}