<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 12:37 PM
 */

namespace Data\Actions\Guardian;


use Data\Actions\Action;
use Data\Repositories\GuardianRepository;

class BaseGuardianAction extends Action
{

    public function __construct(GuardianRepository $repository, $request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }
    public function cryptPassword(){
        return bcrypt($this->request()['password']);
    }
    protected function perform()
    {
        // TODO: Implement perform() method.
    }
}