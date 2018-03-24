<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 1:00 PM
 */

namespace Data\Actions\BusinessInfo;



use Data\FileSystem\Images\BusinessImage;

class CreateBusinessInfo extends BaseBusinessInfoAction
{
    protected function perform()
    {
        $info = $this->request();
        $img = new BusinessImage($this->request()['logo']);
        $img->store();
        $info['logo'] = $img->getStoredName();
        $info = $this->repository->create($info);
        if ($info) {
            return true;
        }
        return false;
    }
}