<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 3:25 PM
 */

namespace Data\Actions\GradeTeacher;


class DeleteGradeTeacher extends  BaseGradeTeacherAction
{
    protected function perform()
    {
        $grade_teacher = $this->repository->delete($this->request());
        if ($grade_teacher) {
            return true;
        }
        return false;
    }
}