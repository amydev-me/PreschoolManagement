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
        $student = Student::find($this->request()['id']);
        if ($student) {
            $this->repository->removeStudent($student);
            $img = new StudentImage($student['profile']);
            if ($img->checkfile()) {

                $img->delete();
            }
            $history = new StudentFile($student['history']);
            if ($history->checkfile()) {
                $history->delete();
            }
            return true;
        }

        return false;
    }
}