<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 28/03/2018
 * Time: 9:11 AM
 */

namespace Data\Actions\Student;


use Data\Actions\User\CreateUser;
use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Helper\GenerateCodeNo;
use Data\Models\Term;
use Data\Repositories\StudentRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;

class CreateStudent extends BaseStudentAction
{
    private $userRepo,$req;

    public function __construct(StudentRepository $repository, UserRepository $userRepo, $request = null, $_req = null)
    {
        parent::__construct($repository, $request);
        $this->userRepo = $userRepo;
        $this->req=$_req;
    }

    protected function perform()
    {
//        $student = $this->request();
        $student=new Request();
        try {
            $student['academic_id']=$this->request()['academic_id'];
            $student['guardian_id']=null;
            $student['studentCode']= $this->getLastCode();
            $student['profile']= $this->storeImage();
            $student['history'] = $this->storeHistory();
            $student['firstName']=$this->request()['firstName'];
            $student['lastName']=$this->request()['lastName'];
            $student['fullName']=$this->request()['fullName'];
            $student['email']=$this->request()['email'];
            $student['dateofbirth']=$this->request()['dateofbirth'];
            $student['gender']=$this->request()['gender'];
            $student['phone']=$this->request()['phone'];
            $student['nrc']=$this->request()['nrc'];
            $student['nationality']=$this->request()['nationality'];
            $student['join_date']=$this->request()['join_date'];
            $student['benefit']=$this->request()['benefit'];
            $student['meal_preferences']=$this->request()['meal_preferences'];
            $student['allergies']=$this->request()['allergies'];
            $student['address']=$this->request()['address'];
            $_student = $this->repository->create($student->all());
            if ($_student) {
                $student['id'] = $_student['id'];
                $this->createUser($student['id']);
                $input = $this->request();

                if ($input['firstterm']=='true') {
                    $term_one = Term::where('grade_id', $input['grade_id'])->where('term_type', $input['fterm_type'])->where('time_type', $input['ftime_type'])->first();
                    $_student->terms()->attach( [$term_one->id]);
                }
                if ($input['secondterm']=='true') {
                    $term_two = Term::where('grade_id', $input['grade_id'])->where('term_type', $input['sterm_type'])->where('time_type', $input['stime_type'])->first();
                    $_student->terms()->attach( [$term_two->id]);
                }
                return true;
            }
        } catch (\Exception $e) {
            $this->repository->removeStudent($student['id']);
            $img = new StudentImage($student['profile']);
            if ($img->checkfile()) {
                $img->delete();
            }
            $history = new StudentFile($student['history']);
            if ($history->checkfile()) {
                $history->delete();
            }
            return false;
        }
        return false;
    }

    private function storeImage()
    {
        $img = new StudentImage($this->request()['profile']);
        $img->store();
        return $img->getStoredName();
    }

    private function storeHistory()
    {
        if ($this->req->hasFile('history')) {
            $history = new StudentFile($this->request()['history']);
            $history->store();
            return $history->getStoredName();
        }
        return '';
    }


    private function getLastCode()
    {
        $code = $this->repository->getLastCode();
        return GenerateCodeNo::studentcode($code['studentCode']);
    }


    private function createUser($student_id)
    {
        $admin = new Request();
        $admin['username'] = $this->request()['username'];
        $admin['password'] = $this->cryptPassword();
        $admin['type'] = 'student';
        $admin['access_id'] = $student_id;
        $action = new CreateUser($this->userRepo, $admin->all());
        $action->invoke();
    }
}