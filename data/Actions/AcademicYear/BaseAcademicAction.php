<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:00 AM
 */

namespace Data\Actions\AcademicYear;


use Data\Actions\Action;
use Data\Repositories\AcademicYearRepository;

class BaseAcademicAction extends Action
{
    public function __construct(AcademicYearRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform()
    {

    }
}