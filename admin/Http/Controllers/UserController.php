<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 9:15 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\User\ChangePassword;
use Data\Actions\User\CheckUsername;
use Data\Actions\User\CreateUser;
use Data\Actions\User\DeleteUser;
use Data\Actions\User\GetUserByRole;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class UserController extends Controller
{
    private $repo;
    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('user.index');
    }

    public function create(Request $request)
    {
        $action=new CreateUser($this->repo,$request->all());
        $result=$action->invoke();

        return response()->json(['success'=>$result]);
    }

    public function update(Request $request)
    {
        $action=new ChangePassword($this->repo,$request->all());
        $result=$action->invoke();

        return response()->json(['success'=>$result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];

        $action = new DeleteUser($this->repo, $_req);
        $result = $action->invoke();

        return response()->json(['success' => $result]);
    }

    public function getUserByRole(){

        $action = new GetUserByRole($this->repo);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function check_username($q)
    {
        $_req = ['username' => $q];
        $action = new CheckUsername($this->repo, $_req);
        $result = $action->invoke();

        return response()->json(['valid' => $result]);
    }
}