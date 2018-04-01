<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:35 PM
 */

namespace Data\Actions\Teacher;


use Data\FileSystem\Images\TeacherImage;
use Data\Helper\GenerateCodeNo;
use Data\Repositories\TeacherRepository;
use Data\Repositories\UserRepository;
use Illuminate\Http\Request;

class CreateTeacher extends BaseTeacherAction
{
    private $userRepo;
    public function __construct(TeacherRepository $repository,UserRepository $userRepo, $request = null)
    {
        parent::__construct($repository, $request);
        $this->userRepo=$userRepo;
    }

    protected function perform()
    {
        $teacher = $this->request();
        $_teacher=null;
        try {
            $teacher['teacherCode'] = $this->getLastCode();
            $teacher['profile']=$this->storeImage();
            $_teacher = $this->repository->create($teacher);

            if ($_teacher) {

                $this->createUser($_teacher['id']);
                return true;
            }
            return false;

        } catch (\Exception $e) {
            if($_teacher){
                $this->repository->delete($_teacher['id']);
            }
            $img = new TeacherImage($teacher['profile']);
            $img->delete();
            return false;
        }
    }
    private function getLastCode(){
        $code = $this->repository->getLastCode();
        return GenerateCodeNo::teacherCode($code['teacherCode']);

    }

    private function storeImage(){
        $img = new TeacherImage($this->request()['profile']);
        $img->store();
        return $img->getStoredName();
    }

    private function createUser($teacher_id){
        $admin = new Request();
        $admin['username'] = $this->request()['username'];
        $admin['password'] = $this->cryptPassword();
        $admin['type'] = 'teacher';
        $admin['access_id'] = $teacher_id;
        $this->userRepo->create($admin->all());
    }
}