<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:12 AM
 */

namespace Data\Actions\Grade;


class UpdateGrade extends BaseGradeAction
{
    public function perform()
    {
        $data = $this->repository->update($this->request(), $this->request()['id']);
        if ($data) {
            return true;
        }
        return false;
    }
}