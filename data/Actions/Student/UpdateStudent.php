<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 11:58 AM
 */

namespace Data\Actions\Student;


use Data\FileSystem\Images\StudentImage;
use Data\FileSystem\student_files\StudentFile;
use Data\Repositories\StudentRepository;
use Data\Models\SiblingInformation;
use Data\Models\StudentBackground;
use Data\Models\StudentGuardian;
use Data\Models\StudentMedical;
use Data\Models\StudentPersonalInformation;
class UpdateStudent extends BaseStudentAction
{
    public function __construct(StudentRepository $repository, $data = null, $_req)
    {
        parent::__construct($repository, $data);
        $this->_req = $_req;

    }

    protected function perform()
    {
        $student = json_decode($this->request()['student']);
        $personal_info = json_decode($this->request()['personal_info']);
        $education = json_decode($this->request()['education']);
        $sibling = json_decode($this->request()['sibling_info']);
        $medical = json_decode($this->request()['medical']);
        $guardian = json_decode($this->request()['guardian']);
//        $student = $this->request();
        $info = $this->repository->getStudentDetail($student->id);
        if ($info) {
            $student->profile = $info['profile'];
            if ($this->_req->hasFile('profile')) {
                $student->profile = $this->storeImage();
                if ($info['profile']) {
                    $pf = new StudentImage($info['profile']);
                    if ($pf->checkfile()) {

                        $pf->delete();
                    }
                }
            }

            $education->one_file=$info->student_background['one_file'];
            if ($this->_req->hasFile('edu_one')) {
                $education->one_file = $this->storeFile('edu_one');
                if ($info->student_background['one_file']) {
                    $bfile = new StudentFile($info->student_background['one_file']);
                    if ($bfile->checkfile()) {
                        $bfile->delete();
                    }
                }
            }
            $education->two_file=$info->student_background['two_file'];
            if ($this->_req->hasFile('edu_two')) {
                $education->one_file = $this->storeFile('edu_two');
                if ($info->student_background['two_file']) {
                    $bfile = new StudentFile($info->student_background['two_file']);
                    if ($bfile->checkfile()) {
                        $bfile->delete();
                    }
                }
            }

            $medical->immunized_file=$info->student_medical['immunized_file'];
            if ($this->_req->hasFile('medical_files')) {
                $medical->immunized_file = $this->storeFile('medical_files');
                if ($info->student_medical['immunized_file']) {
                    $bfile = new StudentFile($info->student_medical['immunized_file']);
                    if ($bfile->checkfile()) {
                        $bfile->delete();
                    }
                }
            }


            $this->repository->update((array)$student, $student->id, 'id');
            StudentPersonalInformation::where('student_id',$student->id)->update((array)$personal_info);
            StudentBackground::where('student_id',$student->id)->update((array)$education);
            SiblingInformation::where('student_id',$student->id)->update((array)$sibling);
            StudentMedical::where('student_id',$student->id)->update((array)$medical);
            StudentGuardian::where('student_id',$student->id)->update((array)$guardian);
            return true;
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
        if ($this->_req->hasFile($inputfile)) {
            $history = new StudentFile($this->request()[$inputfile]);
            $history->store();
            return $history->getStoredName();
        }
        return '';
    }
}