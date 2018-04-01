<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 30/03/2018
 * Time: 12:26 PM
 */

namespace Data\Actions\Student;


use Data\Models\Student;

class GetStudentDetail extends BaseStudentAction
{
    protected function perform()
    {

        $student=$this->repository->getStudentDetail($this->request()['id']);

        return ['student'=>$student];
    }
}