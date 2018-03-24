<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\AcademicYear;


class Delete extends BaseAcademicAction
{
    protected function perform()
    {
        $academic = $this->repository->delete($this->request());
        if ($academic) {
            return true;
        }
        return false;
    }
}