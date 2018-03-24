<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\AcademicYear;

class Update extends BaseAcademicAction
{
    protected function perform()
    {
        $academic =$this->repository->update($this->request(),$this->request()['id']);
        if ($academic) {
            return true;
        }
        return false;
    }
}