<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 05/04/2018
 * Time: 3:48 PM
 */

namespace Data\Actions\Grade;


class GetGrades extends BaseGradeAction
{
    protected function perform()
    {
       return $this->repository->getData($this->request()['academic_id']);
    }
}