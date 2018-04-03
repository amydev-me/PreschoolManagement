<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 10:39 AM
 */

namespace Data\Actions\GradeTeacher;


use Data\Actions\Action;
use Data\Repositories\GradeTeacherRepository;

class BaseGradeTeacherAction extends Action
{
    public function __construct(GradeTeacherRepository $repository, $request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform()
    {

    }
}