<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 05/04/2018
 * Time: 3:57 PM
 */

namespace Data\Actions\Grade;




class GetByCategory extends BaseGradeAction
{
    protected function perform()
    {
        return $this->repository->getGradeByAcademicYear($this->request());
    }
}