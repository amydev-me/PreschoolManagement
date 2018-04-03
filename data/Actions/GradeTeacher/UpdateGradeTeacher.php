<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 3:07 PM
 */

namespace Data\Actions\GradeTeacher;


class UpdateGradeTeacher extends BaseGradeTeacherAction
{
    protected function perform()
    {
        $class_teacher =$this->repository->update($this->request(),$this->request()['id']);
        if ($class_teacher) {
            return true;
        }
        return false;
    }
}