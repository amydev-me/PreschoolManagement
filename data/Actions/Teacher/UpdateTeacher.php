<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:35 PM
 */

namespace Data\Actions\Teacher;


use Data\FileSystem\Images\TeacherImage;
use Data\Repositories\TeacherRepository;

class UpdateTeacher extends BaseTeacherAction
{
    private $_req;

    public function __construct(TeacherRepository $repository, $data = null, $_req)
    {
        parent::__construct($repository, $data);
        $this->_req = $_req;
    }

    protected function perform()
    {
        $teacher = $this->request();

        $info = $this->repository->getDetail($teacher['id']);

        if ($info) {
            if ($this->_req->hasFile('profile')) {
                $img = new TeacherImage($teacher['profile']);
                $img->store();
                $teacher['profile'] = $img->getStoredName();
                if ($info['profile']) {
                    $img = new TeacherImage($info['profile']);
                    if ($img->checkfile()) {
                        $img->delete();
                    }
                }
            } else {
                $teacher['profile'] = $info['profile'];
            }
            $this->repository->update($teacher, $teacher['id']);
            return true;
        }

        return false;
    }
}