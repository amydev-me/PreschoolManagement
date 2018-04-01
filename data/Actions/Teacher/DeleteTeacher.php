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
    private $adminRepo;

    public function __construct(TeacherRepository $repository, UserRepository $adminRepo, $data = null)
    {
        parent::__construct($repository, $data);
        $this->adminRepo = $adminRepo;
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

            $this->adminRepo->removeUser($student['id'], 'teacher');
            return true;
        }

        return false;
    }
}