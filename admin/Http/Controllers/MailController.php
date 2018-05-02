<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/04/2018
 * Time: 3:23 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Models\BusinessInfo;
use Data\Models\Payment;
use Data\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    private $payRepo;

    public function __construct(PaymentRepository $payRepo)
    {
        $this->payRepo = $payRepo;
    }

    public function getDetail(Request $request)
    {

        $info = BusinessInfo::first();
////        $invoice = new BusinessImage($info['invoice_logo']);
////        $info['invoice_logo']=$invoice->getStoragePath();
////        return $info['invoice_logo'];

        $payment = Payment::with('fees', 'term', 'student', 'grade', 'grade.academic', 'student.student_guardian')->where('id', $request->payment_id)->first();
        if (!$payment) return;
        if (!$payment->student) return;

        $_guardian = $payment->student->student_guardian;
        $cvfilePath = storage_path() . '/app/tmp/';

        if ($_guardian['g_one_email']) {
            if (filter_var($_guardian['g_one_email'], FILTER_VALIDATE_EMAIL)) {
                $filename = $payment->invoice . '_1.pdf';
                $filepath = $cvfilePath . $filename;
                $guardian = new \stdClass();
                $guardian->name = $_guardian['g_one_name'];
                $guardian->email = $_guardian['g_one_email'];
                $guardian->address = $_guardian['g_one_address'];
                $guardian->phone = $_guardian['g_one_mobile'] . ',' . $_guardian['g_one_home'] . ',' . $_guardian['g_one_work'];

                PDF::loadView('payment.viewok', compact('info', 'payment', 'guardian'))->save($filename);;

                Mail::send('test', [], function ($message) use ($filename, $filepath) {
                    $message->from('info@schoolapp.axiom.com.mm');
                    $message->to('moesat68@googlemail.com')->subject('Invoice From Central Park');

                    $message->attach($filepath);
                });
            }

            if ($_guardian['g_two_email']) {
                if (filter_var($_guardian['g_two_email'], FILTER_VALIDATE_EMAIL)) {
                    $filename = $payment->invoice . '_2.pdf';
                    $filepath = $cvfilePath . $filename;
                    $guardian = new \stdClass();
                    $guardian->name = $_guardian['g_two_name'];
                    $guardian->email = $_guardian['g_two_email'];
                    $guardian->address = $_guardian['g_two_address'];
                    $guardian->phone = $_guardian['g_two_mobile'] . ',' . $_guardian['g_two_home'] . ',' . $_guardian['g_two_work'];
                    PDF::loadView('payment.viewok', compact('info', 'payment', 'guardian'))->save($filename);;
                    Mail::send('test', [], function ($message) use ($filename, $filepath) {
                        $message->from('info@schoolapp.axiom.com.mm');
                        $message->to('moesat68@googlemail.com')->subject('Invoice From Central Park');

                        $message->attach($filepath);
                    });
                }
            }

//        return $pdf->download($payment->invoice.'_1.pdf');
//        PDF::loadView('payment.viewok')->save($cvfilePath);
        }

    }
}