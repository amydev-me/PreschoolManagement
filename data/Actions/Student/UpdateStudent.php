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

class UpdateStudent extends BaseStudentAction
{
    public function __construct(StudentRepository $repository, $data = null, $_req)
    {
        parent::__construct($repository, $data);
        $this->_req = $_req;

    }

    protected function perform()
    {
        $student = $this->request();
        $info = $this->repository->getStudentDetail($this->request()['id']);
        if ($info) {
            if ($this->_req->hasFile('profile')) {
                $img = new StudentImage($student['profile']);
                $img->store();
                $student['profile'] = $img->getStoredName();
                if ($info['profile']) {
                    $pf = new StudentImage($info['profile']);
                    if ($pf->checkfile()) {

                        $pf->delete();
                    }
                }
            } else {
                $student['profile'] = $info['profile'];
            }
            if ($this->_req->hasFile('history')) {
                $img = new StudentFile($student['history']);
                $img->store();
                $student['history'] = $img->getStoredName();
                if ($info['history']) {
                    $img = new StudentFile($info['history']);
                    $img->delete();
                }

            } else {
                $student['history'] = $info['history'];
            }
            $this->repository->update($student, $student['id'], 'id');
            return true;
        }
        return false;
    }
}