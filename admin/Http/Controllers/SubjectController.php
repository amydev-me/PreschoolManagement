<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 10:49 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Subject\AsyncGet;
use Data\Actions\Subject\FilterByName;
use Data\Actions\Subject\CreateSubject;
use Data\Actions\Subject\DeleteSubject;
use Data\Actions\Subject\GetSubjects;
use Data\Actions\Subject\UpdateSubject;
use Data\Repositories\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class SubjectController extends Controller
{
    private $repository;
    public function __construct(SubjectRepository $repository)
    {
        $this->repository=$repository;
    }
    public function index()
    {
        return view('subject.index');
    }

    public function getData()
    {
        $action = new GetSubjects($this->repository);
        $result = $action->invoke();

        return response()->json($result);
    }

    public function create(Request $request)
    {

        $action = new CreateSubject($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $action = new UpdateSubject($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteSubject($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function filterByName($name)
    {
        $_req['subjectName'] = $name;
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