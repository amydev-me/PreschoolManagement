<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 11:28 AM
 */

namespace Admin\Http\Controllers;




use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\AcademicYear\AsyncGet;
use Data\Actions\AcademicYear\Create;
use Data\Actions\AcademicYear\Delete;
use Data\Actions\AcademicYear\FilterByName;
use Data\Actions\AcademicYear\Get;
use App\Http\Controllers\Controller;
use Data\Actions\AcademicYear\Update;
use Data\Repositories\AcademicYearRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class AcademicController extends Controller
{
    private $repository;

    public function __construct(AcademicYearRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('academic.index');
    }

    public function getData()
    {
        $action = new Get($this->repository);
        $result = $action->invoke();

        return response()->json($result);
    }

    public function create(Request $request)
    {
        $rules = [
            'academicName' => 'required',
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new Create($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id'=>'required',
            'academicName' => 'required',
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new Update($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new Delete($this->repository, $_req);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function filterByName($name)
    {
        $_req['academicName'] = $name;
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