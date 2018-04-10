<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 10/04/2018
 * Time: 8:52 AM
 */

namespace Data\Repositories;


use Data\Models\PaymentDetail;

class PaymentDetailRepository extends Repository
{
    function model(){
        return PaymentDetail::class;
    }
}