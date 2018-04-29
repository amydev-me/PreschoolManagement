<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/04/2018
 * Time: 3:23 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Payment\GetPaymentDetail;
use Data\FileSystem\Images\BusinessImage;
use Data\Models\BusinessInfo;
use Data\Models\Payment;
use Data\Models\Student;
use Data\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MailController extends Controller
{
    private $payRepo;
    public function __construct(PaymentRepository $payRepo)
    {
        $this->payRepo=$payRepo;
    }
    public function getDetail(Request $request){

        $info= BusinessInfo::first();
//        $invoice = new BusinessImage($info['invoice_logo']);
//        $info['invoice_logo']=$invoice->getStoragePath();
//        return $info['invoice_logo'];

        $payment=Payment::with('fees','term','student','grade','grade.academic','student.student_guardian')->where('id',$request->payment_id)->first();

        if(!$payment) return;
        if(!$payment->student) return;

        $_guardian=$payment->student->student_guardian;
//        $action=new GetPaymentDetail($this->payRepo,$request->all());
//        $payment= $action->invoke();
//        $cvfilePath = storage_path() . '/app/other/invoice_pdf/test_invoice.pdf';
//        view()->share('info',$info);

        if($_guardian['g_one_email']){
            if (filter_var($_guardian['g_one_email'], FILTER_VALIDATE_EMAIL)) {

                $guardian=new \stdClass();
                $guardian->name=$_guardian['g_one_name'];
                $guardian->email=$_guardian['g_one_email'];
                $guardian->address=$_guardian['g_one_address'];
                $guardian->phone=$_guardian['g_one_mobile'].','.$_guardian['g_one_home'].','.$_guardian['g_one_work'];

                $pdf= PDF::loadView('payment.viewok',compact('info','payment','guardian'));
                return $pdf->download($payment->invoice.'_1.pdf');
            }
        }


        if($_guardian['g_two_email']){
            if (filter_var($_guardian['g_two_email'], FILTER_VALIDATE_EMAIL)) {

                $guardian=new \stdClass();
                $guardian->name=$_guardian['g_two_name'];
                $guardian->email=$_guardian['g_two_email'];
                $guardian->address=$_guardian['g_two_address'];
                $guardian->phone=$_guardian['g_two_mobile'].','.$_guardian['g_two_home'].','.$_guardian['g_two_work'];

                $pdf= PDF::loadView('payment.viewok',compact('info','payment','guardian'));
                return $pdf->download($payment->invoice.'_2.pdf');
            }
        }

//        return view('payment.viewok');
//        PDF::loadView('payment.viewok')->save($cvfilePath);
    }

}