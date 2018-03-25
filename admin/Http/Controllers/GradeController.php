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
use Data\Repositories\GradeRepository;
use Data\Repositories\TermRepository;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    private $repository,$termRepo;
    public function __construct(GradeRepository $repository,TermRepository $termRepo)
    {
        $this->repository=$repository;
        $this->termRepo=$termRepo;
    }

    public function index(){
        return view('grade.index');
    }

    public function create(Request $request){
        $action=new CreateGrade($this->repository,$this->termRepo,$request->all());
        $result=$action->invoke();
        return response()->json(['success'=>$result]);
    }
}