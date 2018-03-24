<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 4:33 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\FeeType\AsyncGet;
use Data\Actions\FeeType\CreateFeeType;
use Data\Actions\FeeType\DeleteFeeType;
use Data\Actions\FeeType\FilterByName;
use Data\Actions\FeeType\GetFeeTypes;
use Data\Actions\FeeType\UpdateFeeType;
use Data\Repositories\FeeRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class FeesTypeController extends Controller
{
    private $repository;
    public function __construct(FeeRepository $repository)
    {
        $this->repository=$repository;
    }
    public function index()
    {
        return view('fee.index');
    }

    public function getData()
    {
        $action = new GetFeeTypes($this->repository);
        $result = $action->invoke();

        return response()->json($result);
    }

    public function create(Request $request)
    {

        $action = new CreateFeeType($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $action = new UpdateFeeType($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteFeeType($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function filterByName($name)
    {
        $_req['categoryName'] = $name;
        $action = new FilterByName($this->repository, $_req);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function asyncget(){
        $action = new AsyncGet($this->repository);
        $result = $action->invoke();
        return response()->json($result);
    }
}