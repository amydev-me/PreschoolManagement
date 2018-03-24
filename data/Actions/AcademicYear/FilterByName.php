<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\AcademicYear;


class FilterByName extends BaseAcademicAction
{
    protected function perform()
    {
        $academics = $this->repository->getByNameWithPaginate($this->request()['academicName'], 'academicName', $this->pages);
        return $academics;
    }
}