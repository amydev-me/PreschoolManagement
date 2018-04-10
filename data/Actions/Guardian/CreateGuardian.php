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
    public function __construct(GuardianRepository $repository, $request = null)
    {
        parent::__construct($repository, $request);

    }

    protected function perform()
    {
        $guardian = $this->request();

        $_guardian = $this->repository->create($guardian);

        if ($_guardian) {
         return $_guardian;
        }
        return null;
    }
}