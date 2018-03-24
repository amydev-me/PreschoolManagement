<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\AcademicYear;


class Get extends BaseAcademicAction
{
    protected function perform()
    {
        return $this->repository->getdata($this->pages);
    }
}