<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 9:58 AM
 */

namespace Data\Actions\Grade;


use Data\Actions\Action;
use Data\Repositories\GradeRepository;

class BaseGradeAction extends Action
{
    public function __construct(GradeRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform()
    {

    }
}