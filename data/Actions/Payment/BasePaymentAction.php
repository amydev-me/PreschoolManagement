<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/04/2018
 * Time: 10:24 PM
 */
namespace Data\Actions\Payment;


use Data\Actions\Action;
use Data\Repositories\PaymentRepository;

class BasePaymentAction extends Action

{
    public function __construct(PaymentRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform()
    {

    }
}