<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 05/04/2018
 * Time: 11:27 PM
 */

namespace Data\Actions\Term;


class CreateTerm extends BaseTermAction
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