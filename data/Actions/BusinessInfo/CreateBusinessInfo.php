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
        if(isset($this->request()['invoice_logo'])){
            $invoicelogo = new BusinessImage($this->request()['invoice_logo']);
            $invoicelogo->store();
            $info['invoice_logo'] = $invoicelogo->getStoredName();
        }

        $info = $this->repository->create($info);
        if ($info) {
            config(['mail.username' => $info['email']]);
            config(['mail.password' => $info['email_password']]);
            config(['mail.encryption' =>$info['email_encryption']]);
            config(['mail.port' => $info['email_port']]);
            config(['mail.host' =>$info['email_host']]);
            return true;
        }
        return false;
    }
}