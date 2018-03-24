<?php


namespace Data\Actions\AcademicYear;

class AsyncGet extends BaseAcademicAction
{
    protected function perform()
    {
        $academics = $this->repository->asyncGetData();
        return $academics;
    }
}