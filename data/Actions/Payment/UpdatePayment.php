<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/04/2018
 * Time: 11:25 PM
 */

namespace Data\Actions\Payment;


use Data\Models\Payment;

class UpdatePayment extends BasePaymentAction
{
    protected function perform()
    {
        $_payment = $this->request()['payment'];


        $payment = Payment::where('id', $_payment['id'])->first();

        if ($payment) {
            $this->repository->update( $this->request()['payment'], $_payment['id']);
            $payment->fees()->detach();
            $payment->fees()->attach( $this->request()['fees']);
            return true;
        }
        return false;
    }
}