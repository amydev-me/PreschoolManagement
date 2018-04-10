<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/04/2018
 * Time: 9:30 AM
 */

namespace Data\Actions\Grade;


class GetGradeOfTerms extends BaseGradeAction
{
    protected function perform()
    {
       return $this->repository->getGradeOfTerms($this->request['grade_id']);
    }
}