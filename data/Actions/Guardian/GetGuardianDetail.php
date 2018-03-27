<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 1:59 PM
 */

namespace Data\Actions\Guardian;


class GetGuardianDetail extends BaseGuardianAction
{
    protected function perform()
    {
        $batch = $this->repository->getDetail($this->request()['id']);
        return $batch;
    }
}