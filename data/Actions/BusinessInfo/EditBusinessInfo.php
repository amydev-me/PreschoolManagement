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
    protected $rules=[
        'title'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'email'=>'required'
    ];
    private $_req;

    public function __construct(InfoRepository $repository, $data = null, $_req)
    {
        parent::__construct($repository, $data);
        $this->_req=$_req;
    }

    protected function perform()
    {
        $info = $this->_req->except('remove');

        $_info = $this->repository->getInfo();

        if ($_info) {
            if ($this->_req->hasFile('logo')) {
                $img = new BusinessImage($info['logo']);
                $img->store();
                $info['logo'] = $img->getStoredName();
                if ($info['logo']) {
                    if($_info['logo'] !='' && $_info!=null){
                        $img = new BusinessImage($_info['logo']);

                        if($img->checkfile()){
                            $img->delete();
                        }
                    }

                }
            } else {
                if($this->request()['remove'] == 'true'){
                    if($_info['logo'] !='' && $_info!=null){
                        $img = new BusinessImage($_info['logo']);
                        if($img->checkfile()) {
                            $img->delete();
                        }
                    }

                    $info['logo'] = null;
                }else{
                    $info['logo'] = $_info['logo'];
                }
            }
            $this->repository->update($info, $_info['id']);
            return true;
        }

        return false;
    }
}