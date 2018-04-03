<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 1:52 PM
 */

namespace Data\Actions\BusinessInfo;




use Data\FileSystem\Images\BusinessImage;
use Data\Models\BusinessInfo;
use Data\Repositories\InfoRepository;


class EditBusinessInfo extends BaseBusinessInfoAction
{
    protected $rules = [
        'title' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'email' => 'required'
    ];
    private $_req;

    public function __construct(InfoRepository $repository, $data = null, $_req)
    {
        parent::__construct($repository, $data);
        $this->_req = $_req;
    }

    protected function perform()
    {
        $info = $this->_req->except('remove');

        $_info = $this->repository->getInfo();

        if ($_info) {

            if ($this->request()['remove'] == true) {
                $this->removeImage($_info['logo']);
                $_info['logo'] = null;
            }


            if ($this->_req->hasFile('logo')) {
                $this->removeImage($_info['logo']);
                $img = new BusinessImage($info['logo']);
                $img->store();
                $info['logo'] = $this->storeImage($info['logo']);

            } else {
                $info['logo'] = $_info['logo'];
            }


            $this->repository->update($info, $_info['id']);
            return true;
        }

        return false;
    }

    private function storeImage($logo)
    {
        $img = new BusinessImage($logo);
        $img->store();
        return $img->getStoredName();
    }

    private function removeImage($logo)
    {
        if ($logo != null) {
            $img = new BusinessImage($logo);
            if ($img->checkfile()) {
                $img->delete();
            }
        }
    }
}