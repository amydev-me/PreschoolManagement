<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 06/04/2018
 * Time: 4:16 PM
 */

namespace Data\Actions\Term;


class GetTermByCategory extends BaseTermAction
{
    protected function perform()
    {
        return $this->repository->getByCategory($this->request());
    }
}