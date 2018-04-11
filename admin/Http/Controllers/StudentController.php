<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\AcademicYear\AsyncGet;
use Data\Actions\Student\CreateStudent;
use Data\Actions\Student\DeleteStudent;
use Data\Actions\Student\GetStudentByGrade;
use Data\Actions\Student\GetStudentDetail;
use Data\Actions\Student\GetStudents;
use Data\Actions\Student\UpdateStudent;
use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Models\Grade;
use Data\Models\Student;
use Data\Repositories\AcademicYearRepository;
use Data\Repositories\CategoryRepository;
use Data\Repositories\GradeRepository;
use Data\Repositories\StudentRepository;
use Data\Repositories\TermRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Validator;

class StudentController extends Controller
{
    private $repository,  $acaRepo, $catRepo;
    private $pages = 20;

    public function __construct(StudentRepository $repo,  AcademicYearRepository $acaRepo, CategoryRepository $catRepo)
    {
        $this->repository = $repo;




        $this->acaRepo = $acaRepo;

        $this->catRepo = $catRepo;
    }

    public function index()
    {
        return view('student.index');
    }

    public function createIndex()
    {
        return view('student.create');
    }

    public function detailIndex()
    {
        return view('student.detail');
    }

    public function create(Request $request)
    {
        $rules = [

            'academic_id' => 'required',
            'grade_id' => 'required',
            'guardian_id' => 'required',
            'join_date' => 'required',
            'email' => 'required',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'phone' => 'required|max:255',
            'gender' => 'required|max:6',
            'dateofbirth' => 'required|max:255',
            'nrc' => 'required|max:255',
            'nationality' => 'required|max:255',
            'meal_preferences' => 'required',
            'allergies' => 'required'
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new CreateStudent($this->repository, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $rules = [



            'guardian_id' => 'required',
            'join_date' => 'required',
            'email' => 'required',
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'phone' => 'required|max:255',
            'gender' => 'required|max:6',
            'dateofbirth' => 'required|max:255',
            'nrc' => 'required|max:255',
            'nationality' => 'required|max:255',
            'meal_preferences' => 'required',
            'allergies' => 'required'
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new UpdateStudent($this->repository, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteStudent($this->repository, $this->userRepo, $_req);
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
        $students = Student::with('grade')
            ->orWhere('studentCode', 'LIKE', $request->param . '%')
            ->orWhere('fullName', 'LIKE', $request->param . '%')
            ->orWhere('phone', 'LIKE', $request->param . '%')
            ->orWhere('email', 'LIKE', $request->param . '%')
            ->orWhere('nrc', 'LIKE', $request->param . '%')
            ->where('academic_id', $academic->id)
            ->paginate($this->pages);

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

    public function getbyGrade(Request $request){
        $action=new GetStudentByGrade($this->repository,$request->all());
        $result=$action->invoke();
        return response()->json($result);
    }
}