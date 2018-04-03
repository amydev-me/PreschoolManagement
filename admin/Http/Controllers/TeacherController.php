<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:47 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Teacher\AsyncTeacher;
use Data\Actions\Teacher\CreateTeacher;
use Data\Actions\Teacher\DeleteTeacher;
use Data\Actions\Teacher\GetTeacherDetail;
use Data\Actions\Teacher\GetTeachers;
use Data\Actions\Teacher\UpdateTeacher;
use Data\FileSystem\Images\TeacherImage;

use Data\Models\GradeTeacher;
use Data\Repositories\TeacherRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class TeacherController extends Controller
{
    private $repository, $userRepo;

    public function __construct(TeacherRepository $repository, UserRepository $userRepository)
    {
        $this->repository=$repository;
        $this->userRepo=$userRepository;
    }

    public function index(){
        return view('teacher.index');
    }

    public function createIndex(){
        return view('teacher.create');
    }

    public function detailIndex(){
        return view('teacher.detail');
    }

    public function create(Request $request){
        $rules = [
            'username' => 'required|unique:users',
            'password' => 'required',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'dateofbirth' => 'required',
            'join_date' => 'required',
            'salary' => 'required',
            'position' => 'required|max:255',
            'gender' => 'required',
            'phone' => 'required|max:255',
            'nrc' => 'required|max:255',
            'nationality' => 'required|max:255',
            'address' => 'required',
            'degree' => 'required|max:255',
            'contactFirstName' => 'required|max:255',
            'contactLastName' => 'required|max:255',
            'contactEmail' => 'required|max:255',
            'contactphone' => 'required|max:255',
            'contactrelation' => 'required|max:255',
            'personal_email' => 'required'
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new CreateTeacher($this->repository, $this->userRepo, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);

    }

    public function update(Request $request){
        $rules = [
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'personal_email' => 'required',
            'dateofbirth' => 'required',
            'join_date' => 'required',
            'salary' => 'required',
            'position' => 'required|max:255',
            'gender' => 'required',
            'phone' => 'required|max:255',
            'nrc' => 'required|max:255',
            'nationality' => 'required|max:255',
            'address' => 'required',
            'degree' => 'required|max:255',
            'contactFirstName' => 'required|max:255',
            'contactLastName' => 'required|max:255',
            'contactEmail' => 'required|max:255',
            'contactphone' => 'required|max:255',
            'contactrelation' => 'required|max:255',
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new UpdateTeacher($this->repository, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success'=>$result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteTeacher($this->repository, $this->userRepo, $_req);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getData(){
        $action = new GetTeachers($this->repository);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function getDetail($id){
        $_req = ['id' => $id];
        $action = new GetTeacherDetail($this->repository, $_req);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function getImage($name)
    {
        $img = new TeacherImage($name);

        if ($img->checkfile()) {
            return $img->getFileResponse();
        }
        return response()->file($img->defaultImage());
    }

    public function asyncget($q){
        $_req=['fullName'=>$q];
        $action = new AsyncTeacher($this->repository,$_req);
        $result = $action->invoke();
        return response()->json($result);
    }
}