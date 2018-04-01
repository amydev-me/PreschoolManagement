<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 11:10 PM
 */

namespace Data\Actions\Teacher;


class GetTeachers extends BaseTeacherAction
{
    protected function perform()
    {
        $teachers = $this->repository->getAll($this->pages);
        return $teachers;
    }
}