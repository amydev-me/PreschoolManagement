<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:04 AM
 */

namespace Data\Actions\AcademicYear;



class Create extends BaseAcademicAction
{

    protected function perform()
    {
        $academic = $this->repository->create($this->request());
      return $academic;
    }
}