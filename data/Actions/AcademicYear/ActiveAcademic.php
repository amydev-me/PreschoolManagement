<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 2:43 PM
 */

namespace Data\Actions\AcademicYear;


class ActiveAcademic extends BaseAcademicAction
{
    public function perform()
    {
        return $this->repository->activeAcademic();
    }
}