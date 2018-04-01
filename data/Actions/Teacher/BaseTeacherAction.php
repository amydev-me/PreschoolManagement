<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:33 PM
 */

namespace Data\Actions\Teacher;


use Data\Actions\Action;
use Data\Repositories\TeacherRepository;

class BaseTeacherAction extends Action
{

    public function __construct(TeacherRepository $repository, $request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected  function perform()
    {

    }

    public function cryptPassword(){


        return bcrypt($this->request()['password']);
    }
}