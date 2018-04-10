<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/04/2018
 * Time: 10:24 PM
 */

namespace Data\Repositories;



use Data\Helper\GenerateCodeNo;
use Data\Models\Payment;


class PaymentRepository extends Repository
{
    function model()
    {
       return Payment::class;
    }
    public static  function  getLastCode(){
        return  Payment::where('invoice','LIKE',GenerateCodeNo::getInvoicePrefix() . '%')->orderBy('invoice','desc')->select('invoice')->first();
    }
    public function getPaymentDetail($payment_id)
    {
        $payment=Payment::where('id', $payment_id)->first();
        if($payment){
            $fees=$payment->fees;
            $student=$payment->student()->select('id','fullName','phone','address')->first();
            $grade=$payment->grade()->with(['academic'=>function($q){
                $q->select('id','academicName');
            }])->first();
            $term=$payment->term;
            return ['payment'=>$payment,'fees'=>$fees,'student'=>$student,'grade'=>$grade,'term'=>$term];
        }
    }
}