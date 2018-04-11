<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 04/04/2018
 * Time: 9:03 AM
 */

namespace Data\Actions\Teacher;


class FilterTeacher extends BaseTeacherAction
{
    protected function perform()
    {
        $this->repository->filterTeacher($this->request()['param'],$this->pages);
    }
}