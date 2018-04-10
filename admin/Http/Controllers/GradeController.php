<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 9:53 AM
 */

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Data\Actions\Grade\CreateGrade;
use Data\Actions\Grade\DeleteGrade;
use Data\Actions\Grade\GetByCategory;
use Data\Actions\Grade\GetGradeDetail;
use Data\Actions\Grade\GetGradeOfTerms;
use Data\Actions\Grade\GetGrades;
use Data\Actions\Grade\UpdateGrade;
use Data\Models\Grade;
use Data\Repositories\GradeRepository;
use Data\Repositories\SectionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class GradeController extends Controller
{
    private $repository;

    public function __construct(GradeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function detailIndex(Request $request)
    {
        if ($request->grade_id) {
            $grade = Grade::where('id', $request->grade_id)->first();
            if ($grade) {
                return view('grade.action');
            } else {
                return redirect()->route('admin.grade.index');
            }
        }
        return view('grade.action');
    }

    public function index()
    {
        return view('grade.index');
    }

    public function manageIndex(){
        return view('grade.action');
    }

    public function create(Request $request)
    {
        $rules = [
            'grade.gradeName' => 'required',
            'grade.academic_id' => 'required',
            'grade.category_id' => 'required'
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }


        $action = new CreateGrade($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $rules = [
            'grade.gradeName' => 'required',
            'grade.academic_id' => 'required',
            'grade.category_id' => 'required'
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new UpdateGrade($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteGrade($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function getData()
    {
        $academic = Session::get('academic');
        $grade = (new GetGrades($this->repository, ['academic_id' => $academic->id]))->invoke();
        return response()->json(['grades' => $grade, 'academic' => $academic]);
    }

    public function getByCategory(Request $request){
        $academic =Session::get('academic');

        $grade = (new GetByCategory($this->repository,['academic_id'=>$academic->id,'category_id'=>$request->category_id]))->invoke();
        return response()->json(['grades'=>$grade,'academic'=>$academic]);
    }

    public function getDeail(Request $request){
        $grade = (new GetGradeDetail($this->repository,['grade_id'=>$request->grade_id]))->invoke();
        return response()->json($grade);
    }

    public function getGradeByAC(Request $request){
        $grades= Grade::where('academic_id',Session::get('academic')->id)->where('category_id',$request->category_id)->get();
        return response()->json($grades);

    }
    public function getByGradeOfTerms(Request $request){
        $grade = (new GetGradeOfTerms($this->repository,['grade_id'=>$request->grade_id]))->invoke();
        return response()->json($grade);
    }
}