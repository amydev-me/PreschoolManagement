<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 1:00 PM
 */

namespace Data\Actions\BusinessInfo;



use Data\FileSystem\Images\BusinessImage;
use Illuminate\Support\Facades\Session;

class CreateBusinessInfo extends BaseBusinessInfoAction
{
    protected function perform()
    {
        $info = $this->request();
        $img = new BusinessImage($this->request()['logo']);
        $img->store();
        $info['logo'] = $img->getStoredName();
        if(isset($this->request()['invoice_logo'])){
            $invoicelogo = new BusinessImage($this->request()['invoice_logo']);
            $invoicelogo->store();
            $info['invoice_logo'] = $invoicelogo->getStoredName();
        }

        $info = $this->repository->create($info);

        Session::put(['info'=>$info]);
        if ($info) {

            return true;
        }
        return false;
    }
}