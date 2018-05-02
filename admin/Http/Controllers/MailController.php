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
        $payment = Payment::with('fees', 'term', 'student', 'grade', 'grade.academic', 'student.student_guardian')->where('id', $request->payment_id)->first();
        if (!$payment) return;
        if (!$payment->student) return;
        $toMails = [];
        $_student = $payment->student;
        $_guardian = $payment->student->student_guardian;
        if ($_guardian['g_one_email']) {
            if (filter_var($_guardian['g_one_email'], FILTER_VALIDATE_EMAIL)) {
                array_push($toMails,$_guardian['g_one_email']);
            }
        }
        if ($_guardian['g_two_email']) {
            if (filter_var($_guardian['g_two_email'], FILTER_VALIDATE_EMAIL)) {
                array_push($toMails,$_guardian['g_two_email']);
            }
        }



        $filename = $payment->invoice . '_1.pdf';
        $student = new \stdClass();
        $student->name = $_student['fullName'];
        $student->grade = $_student->grade['gradeName'];
        $pdf = PDF::loadView('payment.viewok', compact('info', 'payment', 'student'))->stream($filename);;
        foreach ( $toMails as $mail){
            Mail::send('test', [], function ($message) use ($filename, $mail, $pdf) {
                $message->to($mail);
                $message->subject('Central Park Invoice');
                $message->from('info@schoolapp.axiom.com.mm','Central Park');
                $message->attachData($pdf, $filename, ['mime' => 'application/pdf']);
            });
        }
//        foreach ( $toMails as $mail){
//        Mail::queue(new ClientMail($pdf,$filename,$mail));
//            Mail::queue('test', [], function ($message) use ($filename, $toMails, $pdf) {
//                $message->from('info@schoolapp.axiom.com.mm','Central Park');
//
//                $message->to('moesat68@googlemail.com','yarohkado@gmail.com');
//                $message->subject('HI');
//
//            });
//        }



//        if ($_guardian['g_two_email']) {
//            if (filter_var($_guardian['g_two_email'], FILTER_VALIDATE_EMAIL)) {
//                $filename = $payment->invoice . '_2.pdf';
//                $guardian = new \stdClass();
//                $guardian->name = $_guardian['g_two_name'];
//                $guardian->email = $_guardian['g_two_email'];
//                $guardian->address = $_guardian['g_two_address'];
//                $guardian->phone = $_guardian['g_two_mobile'] . ',' . $_guardian['g_two_home'] . ',' . $_guardian['g_two_work'];
//
//                $to = $guardian->email;
//                $pdf = PDF::loadView('payment.viewok', compact('info', 'payment', 'guardian'))->stream($filename);
//
//                Mail::send('test', ['pdf' => $pdf], function ($message) use ($filename, $to, $pdf) {
//                    $message->from('info@schoolapp.axiom.com.mm');
//                    $message->to($to)->subject('Invoice From Central Park');
//
//                    $message->attachData($pdf, $filename, ['mime' => 'application/pdf']);
//                });
//
//            }
//        }
    }
}


//        return $pdf->download($payment->invoice.'_1.pdf');
//        PDF::loadView('payment.viewok')->save($cvfilePath);
//                    Mail::send('test', [], function ($message) use ($filename, $filepath) {
//                        $message->from('info@schoolapp.axiom.com.mm');
//                        $message->to('moesat68@googlemail.com')->subject('Invoice From Central Park');
//
//                        $message->attach($filepath);
//                    });