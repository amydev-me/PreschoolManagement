<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 12:37 PM
 */

namespace Data\Actions\Guardian;


use Data\Actions\User\CreateUser;
use Data\Repositories\GuardianRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;

class CreateGuardian extends BaseGuardianAction
{
    private $adminRepo;
    public function __construct(GuardianRepository $repository,UserRepository $adminRepo, $request = null)
    {
        parent::__construct($repository, $request);
        $this->adminRepo = $adminRepo;
    }

    protected function perform()
    {
        $guardian = $this->request();

        $_guardian = $this->repository->create($guardian);

        if ($_guardian) {
            $admin = new Request();
            $admin['username'] = $guardian['username'];
            $admin['password'] = $this->cryptPassword();
            $admin['type'] = 'guardian';
            $admin['access_id'] = $_guardian['id'];
            $action=new CreateUser($this->adminRepo,$admin->all());
            $action->invoke();
            return $_guardian;
        }
        return null;
    }
}