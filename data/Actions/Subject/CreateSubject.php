<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:40 PM
 */

namespace Data\Actions\Subject;

class CreateSubject extends BaseSubjectAction
{
    protected function perform()
    {
        $data = $this->repository->create($this->request());
        if ($data) {
            return true;
        }
        return false;
    }
}