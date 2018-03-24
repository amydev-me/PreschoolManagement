<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:51 PM
 */

namespace Data\Actions\Subject;


class FilterByName extends BaseSubjectAction
{
    protected function perform()
    {
        $data = $this->repository->getByNameWithPaginate($this->request()['subjectName'],'subjectName',$this->pages);
        return $data;
    }
}