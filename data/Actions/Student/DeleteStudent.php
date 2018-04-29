<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 12:30 PM
 */

namespace Data\Actions\Student;


use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Models\Student;
use Data\Repositories\StudentRepository;
use Data\Repositories\UserRepository;

class DeleteStudent extends BaseStudentAction
{

    public function __construct(StudentRepository $repository, $request = null)
    {
        parent::__construct($repository, $request);

    }

    protected function perform()
    {
        $student = Student::with('student_personal_information','student_background','student_medical')->find($this->request()['id']);

        if ($student) {
            $this->repository->removeStudent($student);
            $img = new StudentImage($student['profile']);

            if ($img->checkfile()) {

                $img->delete();
            }

            $this->deleteFile($student->student_background['edu_one']);
            $this->deleteFile($student->student_background['edu_two']);
            $this->deleteFile($student->student_medical['medical_files']);
            return true;
        }

        return false;
    }

    private function deleteFile($_file){
        if($_file){
            $history = new StudentFile($_file);
            if ($history->checkfile()) {
                $history->delete();
            }
        }

    }
}