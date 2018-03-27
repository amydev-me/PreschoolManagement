<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:26 AM
 */

namespace Data\Actions\User;


use Data\Actions\Action;
use Data\Repositories\UserRepository;

class BaseUserAction extends Action
{

    public function __construct(UserRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected  function perform()
    {
        // TODO: Implement perform() method.
    }

    public function cryptPassword(){
        return bcrypt($this->request()['password']);
    }
}