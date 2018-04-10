<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/04/2018
 * Time: 1:32 PM
 */

namespace Data\Actions\Payment;


class GetPaymentDetail extends BasePaymentAction
{
    protected function perform()
    {
        return $this->repository->getPaymentDetail($this->request()['payment_id']);
    }
}