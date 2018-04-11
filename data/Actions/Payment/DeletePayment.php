<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 11/04/2018
 * Time: 11:10 AM
 */

namespace Data\Actions\Payment;


class DeletePayment extends BasePaymentAction
{
    public function perform()
    {
        $data = $this->repository->delete($this->request());
        if ($data) {
            return true;
        }
        return false;
    }
}