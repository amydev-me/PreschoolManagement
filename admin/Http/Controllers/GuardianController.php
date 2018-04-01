<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 12:35 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Guardian\AsyncGuardian;
use Data\Actions\Guardian\CreateGuardian;
use Data\Actions\Guardian\GetGuardianDetail;
use Data\Actions\Guardian\GetGuardians;
use Data\Actions\Guardian\UpdateGuardian;
use Data\Models\Guardian;
use Data\Repositories\GuardianRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class GuardianController extends Controller
{
    private $repository, $adminRepo;

    public function __construct(GuardianRepository $repo, UserRepository $adminRepo)
    {
        $this->repository = $repo;
        $this->adminRepo = $adminRepo;
    }

    public function index()
    {
        return view('guardian.index');
    }

    public function detailIndex()
    {
        return view('guardian.detail');
    }

    public function create(Request $request)
    {
        $rules =
            ['username' => 'required|unique:users',
                'password' => 'required',
                'email' => 'required|max:50',
                'firstName' => 'required|max:255',
                'lastName' => 'required|max:255',
                'realation' => 'required|max:255',
                'occupation' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required'
            ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }

        $action = new CreateGuardian($this->repository, $this->adminRepo, $request->all());
        $result = $action->invoke();
        return response()->json($result);
    }

    public function update(Request $request)
    {
        $rules =
            [
                'email' => 'required|max:50',
                'firstName' => 'required|max:255',
                'lastName' => 'required|max:255',
                'realation' => 'required|max:255',
                'occupation' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required'
            ];
        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }

        $action = new UpdateGuardian($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => 'true']);
    }

    public function getData()
    {
        $action = new GetGuardians($this->repository);
        $result = $action->invoke();

        return response()->json($result);
    }

    public function getDetail($id)
    {
        $_req = ['id' => $id];
        $action = new GetGuardianDetail($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return $result->errors();
        }
        return response()->json($result);
    }

    public function asyncget($q){
        $_req=['fullName'=>$q];
       
        $action = new AsyncGuardian($this->repository,$_req);
        $result = $action->invoke();
        return response()->json($result);
    }
}