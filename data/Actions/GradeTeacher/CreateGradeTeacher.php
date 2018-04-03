<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 10:41 AM
 */

namespace Data\Actions\GradeTeacher;


class CreateGradeTeacher extends BaseGradeTeacherAction
{
    protected function perform()
    {
        $grade_teacher = $this->repository->create($this->request());

        if ($grade_teacher) {
            return true;
        }
        return false;
    }
}