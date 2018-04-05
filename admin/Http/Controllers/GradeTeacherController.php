<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 02/04/2018
 * Time: 10:41 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\GradeTeacher\CreateGradeTeacher;
use Data\Actions\GradeTeacher\DeleteGradeTeacher;

use Data\Actions\GradeTeacher\UpdateGradeTeacher;
use Data\Models\GradeTeacher;
use Data\Repositories\AcademicYearRepository;

use Data\Repositories\GradeTeacherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class GradeTeacherController extends Controller
{
    private $repository;

    public function __construct(GradeTeacherRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('grade_teacher.index');
    }

    public function create(Request $request)
    {
        $success =$this->validateData($request);
        if (!$success) {
            return response()->json(['success'=>false], 422);
        }
        $action = new CreateGradeTeacher($this->repository, $request->all());
        $result = $action->invoke();
        if (!$result) {
            return response()->json(['message' => ' Teacher is already assigned for this grade.'], 500);
        }
        return response()->json(['success' => $result]);
    }

    private function validateData($request)
    {
        $rules = [
            'teacher_id' => 'required',
            'academic_id' => 'required',
            'grade_id' => 'required',
            'subject_id' => 'required'];
        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return false;
        }
        return true;
    }

    public function update(Request $request){

        $success =$this->validateData($request);
        if (!$success) {
            return response()->json(['success'=>false], 422);
        }
        $action = new UpdateGradeTeacher($this->repository, $request->all());
        $result = $action->invoke();
        if (!$result) {
            return response()->json(['message' => 'Grade teacher is already assigned for this grade.'], 500);
        }

        return response()->json(['success' => 'true']);
    }

    public function delete($id){
        $_req = ['id' => $id];

        $action = new DeleteGradeTeacher($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        if (!$result) {
            return response()->json('failed', 500);
        }
        return response()->json(['success' => 'true']);
    }

    public function getData()
    {
        $academic =Session::get('academic');
        if ($academic) {
            $grades = GradeTeacher::with(['academic','grade.category', 'grade', 'subject', 'teacher' => function ($q) {
                $q->select('id', 'fullName', 'personal_email');
            }])->where('academic_id', $academic->id)->paginate(20);
            return response()->json($grades);
        }
        return response()->json([]);
    }

    public function getByCategory(Request $request){
        $academic =Session::get('academic');
        if ($academic) {
            $grades = GradeTeacher::with(['academic','grade.category', 'grade', 'subject', 'teacher' =>
                function ($q) {
                $q->select('id', 'fullName', 'personal_email');
            }])->whereHas('grade',
                function($q) use($request){
                    $q->where('category_id',$request->category_id);
            })->where('academic_id', $academic->id)->paginate(20);
            return response()->json($grades);
        }
        return response()->json([]);
    }

    public function getByCategoryAndGrade(Request $request){
        $academic =Session::get('academic');
        if ($academic) {
            $grades = GradeTeacher::with(['academic','grade.category', 'grade', 'subject', 'teacher' =>
                function ($q) {
                    $q->select('id', 'fullName', 'personal_email');
                }])->whereHas('grade',
                function($q) use($request){
                    $q->where('category_id',$request->category_id);
                })->where('academic_id', $academic->id)->where('grade_id',$request->grade_id)->paginate(20);
            return response()->json($grades);
        }

    }

    public function getGradeByTeacher(Request $request){
        $academic =Session::get('academic');
        if ($academic) {
            $grades = GradeTeacher::with(['academic','grade.category', 'grade', 'subject', 'teacher' =>
                function ($q) {
                    $q->select('id', 'fullName', 'personal_email');
                }])->whereHas('grade',
                function($q) use($request){
                    $q->where('teacher_id',$request->teacher_id);
                })->where('academic_id', $academic->id)->get();
            return response()->json($grades);
        }
    }
}