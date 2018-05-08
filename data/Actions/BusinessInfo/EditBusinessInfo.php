<?php

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
        $info = $this->_req->except('remove', 'remove_invoicelogo');

        $_info = $this->repository->getInfo();

        if ($_info) {

            if ($this->request()['remove'] == 'true') {
                $this->removeImage($_info['logo']);
                $_info['logo'] = null;

            }
            if ($this->request()['remove_invoicelogo'] == 'true') {
                $this->removeImage($_info['invoice_logo']);
                $_info['invoice_logo'] = null;
            }

            if ($this->_req->hasFile('logo')) {
                $this->removeImage($_info['logo']);
                $img = new BusinessImage($info['logo']);
                $img->store();
                $info['logo'] = $this->storeImage($info['logo']);

            } else {

                $info['logo'] = $_info['logo'];
            }

            if ($this->_req->hasFile('invoice_logo')) {
                $this->removeImage($_info['invoice_logo']);
                $img = new BusinessImage($info['invoice_logo']);
                $img->store();
                $info['invoice_logo'] = $this->storeImage($info['invoice_logo']);
            } else {

                $info['invoice_logo'] = $_info['invoice_logo'];
            }


            $this->repository->update($info, $_info['id']);

            Session::put(['info'=>$info]);
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