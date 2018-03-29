<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 28/03/2018
 * Time: 9:10 AM
 */

namespace Data\Actions\Student;


use Data\Actions\Action;
use Data\Repositories\StudentRepository;

class BaseStudentAction extends Action
{

    public function __construct(StudentRepository $repository, $request = null)
    {
        parent::__construct($request);
        $this->repository = $repository;
    }

    protected function perform()
    {

    }

    public function cryptPassword(){
        return bcrypt($this->request()['password']);
    }
}