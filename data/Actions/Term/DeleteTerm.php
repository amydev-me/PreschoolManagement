<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 06/04/2018
 * Time: 10:30 AM
 */

namespace Data\Actions\Term;


class DeleteTerm extends BaseTermAction
{
    protected function perform()
    {
        $data = $this->repository->delete($this->request());
        if ($data) {
            return true;
        }
        return false;
    }
}