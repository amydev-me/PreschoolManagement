<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:50 PM
 */

namespace Data\Actions\Subject;


class DeleteSubject extends BaseSubjectAction
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