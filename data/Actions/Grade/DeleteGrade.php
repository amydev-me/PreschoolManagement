<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 10:56 AM
 */

namespace Data\Actions\Grade;


class DeleteGrade extends BaseGradeAction
{
    public function perform()
    {
        $data = $this->repository->delete($this->request());
        if ($data) {
            return true;
        }
        return false;
    }
}