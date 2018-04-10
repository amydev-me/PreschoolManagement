<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 11:36 PM
 */

namespace Data\Actions\Term;


class UpdateTerm extends BaseTermAction
{
    public function perform()
    {

       $data= $this->repository->update($this->request(), $this->request()['id']);
        if ($data) {
            return true;
        }
        return false;
    }
}