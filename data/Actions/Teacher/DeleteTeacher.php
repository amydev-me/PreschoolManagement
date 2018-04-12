<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:35 PM
 */

namespace Data\Actions\Teacher;


use Data\FileSystem\Images\TeacherImage;
use Data\Models\Teacher;
use Data\Repositories\TeacherRepository;
use Data\Repositories\UserRepository;

class DeleteTeacher extends BaseTeacherAction
{


    public function __construct(TeacherRepository $repository, $data = null)
    {
        parent::__construct($repository, $data);

    }

    protected function perform()
    {

        $student = Teacher::find($this->request()['id']);
        if ($student) {
            $this->repository->removeTeacher($student);
            $img = new TeacherImage($student['profile']);
            if ($img->checkfile()) {

                $img->delete();
            }


            return true;
        }

        return false;
    }
}