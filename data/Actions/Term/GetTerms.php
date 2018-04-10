<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 06/04/2018
 * Time: 8:58 AM
 */

namespace Data\Actions\Term;


class GetTerms extends BaseTermAction
{
    protected function perform()
    {

        return $this->repository->getData($this->request()['academic_id']);
    }
}