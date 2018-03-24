<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:42 PM
 */

namespace Data\Actions\Subject;


class UpdateSubject extends BaseSubjectAction
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