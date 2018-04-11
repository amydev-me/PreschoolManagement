<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/04/2018
 * Time: 9:36 AM
 */

namespace Data\Actions\Payment;


use Data\Helper\GenerateCodeNo;

class CreatePayment extends BasePaymentAction
{
    protected function perform()
    {
        $_payment = $this->request()['payment'];
        $_payment['invoice'] = $this->getLastCode();

        $payment = $this->repository->create($_payment);
        if ($payment) {
            foreach ($this->request()['fees'] as $term) {
                $payment->fees()->attach($payment->id, ['fee_id' => $term['fee_id'], 'amount' => $term['amount']]);
            }
            return true;
        }
        return false;
    }

    private function getLastCode()
    {
        $code = $this->repository->getLastCode();
        return GenerateCodeNo::invoice($code['invoice']);

    }
}