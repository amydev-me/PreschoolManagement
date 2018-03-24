<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:44 PM
 */

namespace Data\Actions\Subject;


class GetSubjects extends BaseSubjectAction
{
    public function perform()
    {
        return $this->repository->getData($this->pages);
    }
}