<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 2:12 PM
 */

namespace Data\Actions\Guardian;


class UpdateGuardian extends BaseGuardianAction
{
    protected function perform()
    {
        $info =$this->repository->update($this->request(),$this->request()['id']);
        if ($info) {
            return true;
        }
        return false;
    }
}