<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;


use Data\Actions\Grade\GetGradeOfTerms;
use Data\Actions\Student\CreateStudent;
use Data\Actions\Student\DeleteStudent;
use Data\Actions\Student\GetStudentByGrade;
use Data\Actions\Student\GetStudentDetail;
use Data\Actions\Student\UpdateStudent;
use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Models\Grade;
use Data\Models\Student;
use Data\Repositories\AcademicYearRepository;
use Data\Repositories\CategoryRepository;
use Data\Repositories\GradeRepository;
use Data\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class StudentController extends Controller
{
    private $repository,  $acaRepo, $catRepo,$gradeRepo;
    private $pages = 20;

    public function __construct(StudentRepository $repo,  AcademicYearRepository $acaRepo, CategoryRepository $catRepo,GradeRepository $gradeRepo)
    {
        $this->repository = $repo;

        $this->acaRepo = $acaRepo;

        $this->catRepo = $catRepo;

        $this->gradeRepo = $gradeRepo;
    }

    public function index()
    {
        return view('student.index');
    }

    public function createIndex()
    {
        return view('student.create');
    }

    public function detailIndex(Request $request)
    {
        $action = new GetStudentDetail($this->repository, ['id' => $request->student_id]);
        $result = $action->invoke();

        if($result['student']){
            return view('student.detail');
        }
        return  redirect('admin/student');

    }

    public function create(Request $request)
    {
        $action = new CreateStudent($this->repository, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {

        $action = new UpdateStudent($this->repository, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteStudent($this->repository, $_req);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getDetail(Request $request)
    {
        $action = new GetStudentDetail($this->repository, ['id' => $request->student_id]);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function getImage($name)
    {
        $img = new StudentImage($name);

        if ($img->checkfile()) {
            return $img->getFileResponse();
        }
        return response()->file($img->defaultImage());
    }

    public function getFile($name)
    {
        $img = new StudentFile($name);

        if ($img->checkfile()) {
            return $img->getFileResponse();
        }
        return response()->file($img->defaultImage());
    }

    public function getData()
    {
        $academic = Session::get('academic');
        $students = Student::where('academic_id', $academic->id)->paginate($this->pages);
        return response()->json($students);
    }
    public function getStudentByActiveAcademic()
    {
        $active_academic = Session::get('academic');

        if ($active_academic) {
            $students = Student::with('grade')->where('academic_id', $active_academic->id)->paginate($this->pages);
            return response()->json(['active_academic' => $active_academic, 'students' => $students]);
        }
    }

    public function filterStudent(Request $request)
    {
        $academic = Session::get('academic');
        $query = Student::with('grade')
            ->orWhere('studentCode', 'LIKE', $request->param . '%')
            ->orWhere('fullName', 'LIKE', $request->param . '%');
//            ->orWhere('phone', 'LIKE', $request->param . '%')
//            ->orWhere('email', 'LIKE', $request->param . '%')
//            ->orWhere('nrc', 'LIKE', $request->param . '%')
        if($academic){
         $query->where('academic_id', $academic->id);
        }



         $students= $query->paginate($this->pages);

        return response()->json($students);
    }

    public function getByACG(Request $request)
    {
        $grade_id = $request->grade_id;
        $category_id = $request->category_id;
        $students = Student::where('academic_id', $request->academic_id)
            ->paginate($this->pages);
        return response()->json($students);
    }

    public function getByAC(Request $request)
    {
        $grades = Grade::where('academic_id', $request->academic_id)->where('category_id', $request->category_id)->get();

        $students = Student::where('academic_id', $request->academic_id)->paginate($this->pages);
        return response()->json(['students' => $students, 'grades' => $grades]);
    }

    public function getStudentByGrade(Request $request){
        $students = Student::with('grade')->where('grade_id', $request->grade_id)->paginate($this->pages);
        return response()->json($students);
    }

    public function getbyGrade(Request $request){
        $action=new GetStudentByGrade($this->repository,$request->all());
        $result=$action->invoke();
        return response()->json($result);
    }

    public function getStudentGrade(Request $request){
       $student= Student::where('id',$request->student_id)->first();
        $grade = (new GetGradeOfTerms($this->gradeRepo,['grade_id'=>$student->grade_id]))->invoke();
        return response()->json(['terms'=>$grade,'student'=>$student]);
    }
}