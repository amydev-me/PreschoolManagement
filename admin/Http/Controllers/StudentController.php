<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;

use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\AcademicYear\AsyncGet;
use Data\Actions\Student\CreateStudent;
use Data\Actions\Student\GetStudents;
use Data\FileSystem\Images\StudentImage;
use Data\Models\Student;
use Data\Repositories\AcademicYearRepository;
use Data\Repositories\CategoryRepository;
use Data\Repositories\StudentRepository;
use Data\Repositories\TermRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class StudentController extends Controller
{
    private $repository, $userRepo, $termRepo, $acaRepo, $catRepo;

    public function __construct(StudentRepository $repo, UserRepository $userRepo, TermRepository $termRepo, AcademicYearRepository $acaRepo, CategoryRepository $catRepo)
    {
        $this->repository = $repo;

        $this->userRepo = $userRepo;

        $this->termRepo = $termRepo;

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

    public function create(Request $request)
    {
        $action = new CreateStudent($this->repository, $this->userRepo, $request->all(), $request);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getImage($name)
    {
        $img = new StudentImage($name);
        if ($img->checkfile()) {
            return $img->getFileResponse();
        }
        return response()->file($img->defaultImage());
    }

    private function getActiveAcademic()
    {
        $action = new ActiveAcademic($this->acaRepo);
        $active_academic = $action->invoke();
        return $active_academic;
    }

    private function getAcademics()
    {
        $academicAction = new AsyncGet($this->acaRepo);
        $academics = $academicAction->invoke();
        return $academics;
    }

    private function getCategories()
    {
        $categoryAction = new \Data\Actions\Category\AsyncGet($this->catRepo);
        $categories = $categoryAction->invoke();
        return $categories;
    }

    public function getStudentByActiveAcademic()
    {
        $active_academic = $this->getActiveAcademic();
        $academics = $this->getAcademics();
        $categories = $this->getCategories();
        if ($active_academic) {
            $students = Student::with('terms')->where('academic_id', $active_academic->id)->paginate(20);
            return response()->json(['active_academic' => $active_academic, 'batches' => $academics, 'categories' => $categories, 'students' => $students]);
        }
        return response()->json(['active_academic' => $active_academic, 'batches' => $academics, 'categories' => $categories, 'students' => []]);

    }

    public function filterStudent($param,$academic_id)
    {


       $students= Student::with('terms')->orWhere('studentCode', 'LIKE', $param . '%')
           ->orWhere('fullName', 'LIKE', $param . '%')
           ->orWhere('phone', 'LIKE', $param . '%')
           ->orWhere('email', 'LIKE', $param . '%')
           ->orWhere( 'nrc', 'LIKE', $param . '%')
           ->where('academic_id',1)

            ->paginate(20);

       return response()->json($students);
    }
}