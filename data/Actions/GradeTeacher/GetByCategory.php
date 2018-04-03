<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 11:20 PM
 */

namespace Data\Actions\GradeTeacher;


class GetByCategory extends BaseGradeTeacherAction
{
    protected function perform()
    {
        return $this->repository->getByCategory($this->request()['category_id'],$this->pages);
    }
}