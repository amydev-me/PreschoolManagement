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
use Data\Actions\Grade\UpdateGrade;
use Data\Models\Grade;
use Data\Repositories\GradeRepository;
use Data\Repositories\TermRepository;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    private $repository, $termRepo;

    public function __construct(GradeRepository $repository, TermRepository $termRepo)
    {
        $this->repository = $repository;
        $this->termRepo = $termRepo;
    }

    public function detailIndex(Request $request)
    {
        if($request->grade_id){
            $grade = Grade::where('id', $request->grade_id)->first();
            if($grade){
                return view('grade.action');
            }else{
                return redirect()->route('admin.grade.index');
            }
        }
        return view('grade.action');
    }

    public function index()
    {
        return view('grade.index');
    }

    public function create(Request $request)
    {
        $action = new CreateGrade($this->repository, $this->termRepo, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {

        $action = new UpdateGrade($this->repository, $this->termRepo, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getDetail(Request $request)
    {
        $grade = Grade::with('academic','category')->where('id', $request->grade_id)->first();
        if($grade){
            $_firstFull = $grade->terms()->where('term_type', 't1')->where('time_type', 'Full')->first();
            $_firstHalf = $grade->terms()->where('term_type', 't1')->where('time_type', 'Half')->first();
            $_secondFull = $grade->terms()->where('term_type', 't2')->where('time_type', 'Full')->first();
            $_secondHalf = $grade->terms()->where('term_type', 't2')->where('time_type', 'Half')->first();
            return response()->json(['grade' => $grade, 'first_full' => $_firstFull, 'first_half' => $_firstHalf, 'second_full' => $_secondFull, 'second_half' => $_secondHalf]);
        }
    }

    public function getData(){
        $grade=Grade::with('terms')->get();
        return response()->json($grade);
    }
}