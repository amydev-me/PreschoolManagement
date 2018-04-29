<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 28/03/2018
 * Time: 9:11 AM
 */

namespace Data\Actions\Student;



use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Helper\GenerateCodeNo;
use Data\Models\SiblingInformation;
use Data\Models\StudentBackground;
use Data\Models\StudentGuardian;
use Data\Models\StudentMedical;
use Data\Models\StudentPersonalInformation;
use Data\Repositories\StudentRepository;


class CreateStudent extends BaseStudentAction
{
    private $req;

    public function __construct(StudentRepository $repository, $request = null, $_req = null)
    {
        parent::__construct($repository, $request);

        $this->req = $_req;
    }

    protected function perform()
    {

        $student = json_decode($this->request()['student']);
        $personal_info = json_decode($this->request()['personal_info']);
        $education = json_decode($this->request()['education']);
        $sibling = json_decode($this->request()['sibling_info']);
        $medical = json_decode($this->request()['medical']);
        $guardian = json_decode($this->request()['guardian']);

        try {

            $student->studentCode = $this->getLastCode();
            $student->profile = $this->storeImage();
            $_student = $this->repository->create((array)$student);
            if ($_student) {
//
                $personal_info->student_id = $_student['id'];
                $education->student_id = $_student['id'];
                $education->one_file = $this->storeFile('edu_one');
                $education->two_file = $this->storeFile('edu_two');
                $sibling->student_id = $_student['id'];
                $medical->student_id = $_student['id'];
                $medical->immunized_file = $this->storeFile('medical_files');
                $guardian->student_id = $_student['id'];
                StudentPersonalInformation::create((array)$personal_info);
                StudentBackground::create((array)$education);
                SiblingInformation::create((array)$sibling);
                StudentMedical::create((array)$medical);
                StudentGuardian::create((array)$guardian);
                return true;
            }
        } catch (\Exception $e) {
            $this->repository->removeStudent($student['id']);
            $img = new StudentImage($student['profile']);
            if ($img->checkfile()) {
                $img->delete();
            }
            $edu_one = new StudentFile($education->one_file);
            if ($edu_one->checkfile()) {
                $edu_one->delete();
            }
            $edu_two = new StudentFile($education->two_file);
            if ($edu_two->checkfile()) {
                $edu_two->delete();
            }
            $medical_file = new StudentFile($medical->immunized_file);
            if ($medical_file->checkfile()) {
                $medical_file->delete();
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

    private function storeFile($inputfile)
    {
        if ($this->req->hasFile($inputfile)) {
            $history = new StudentFile($this->request()[$inputfile]);
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
}