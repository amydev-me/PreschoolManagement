<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/04/2018
 * Time: 3:23 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Data\Models\BusinessInfo;
use Data\Models\Payment;
use Data\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    private $payRepo;

    public function __construct(PaymentRepository $payRepo)
    {
        $this->payRepo = $payRepo;
    }
    public function sendOverdue()
    {
        $info = BusinessInfo::first();
        config(['mail.username' => $info->email]);
        config(['mail.password' => $info->email_password]);
        config(['mail.encryption' => $info->email_encryption]);
        config(['mail.port' => $info->email_port]);
        config(['mail.host' => $info->email_host]);

        $payments = Payment::with('fees', 'term', 'student', 'grade', 'grade.academic', 'student.student_guardian')
            ->where('status', 'UNPAID')->where('due_date', '<', Carbon::today())->get();
//        try {
            foreach ($payments as $payment) {
                if (!$payment) return;
                if (!$payment->student) return;
                $toMails = [];
                $_student = $payment->student;
                $_guardian = $payment->student->student_guardian;
                if ($_guardian['g_one_email']) {
                    if (filter_var($_guardian['g_one_email'], FILTER_VALIDATE_EMAIL)) {
                        array_push($toMails, $_guardian['g_one_email']);
                    }
                }
                if ($_guardian['g_two_email']) {
                    if (filter_var($_guardian['g_two_email'], FILTER_VALIDATE_EMAIL)) {
                        array_push($toMails, $_guardian['g_two_email']);
                    }
                }

                $filepath = storage_path() . '/app/tmp/';
                $filename = $filepath . $payment->invoice . '.pdf';

                $student = new \stdClass();
                $student->name = $_student['fullName'];
                $student->grade = $_student->grade['gradeName'];

                if (count($toMails) > 0) {
                    if (!$info->email) redirect()->back();
                    $pdf = PDF::loadView('payment.viewok', compact('info', 'payment', 'student'))->save($filename);
                    Mail::queue(new ClientMail($info, $filename, $toMails));
                    if (!Mail::failures()) {
                        unlink($filename);
                    }
                }
            }
            return redirect()->back();
//        } catch (\Exception $exception) {
//            return redirect()->back();
//        }

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
        $filepath=storage_path().'/app/tmp/';
        $filename =$filepath. $payment->invoice . '.pdf';
        $student = new \stdClass();
        $student->name = $_student['fullName'];
        $student->grade = $_student->grade['gradeName'];
        config(['mail.username'=>$info->email]);
        config(['mail.password'=>$info->email_password]);
        config(['mail.encryption'=>$info->email_encryption]);
        config(['mail.port'=>$info->email_port]);
        config(['mail.host'=>$info->email_host]);

        if(count($toMails)>0){
            if(!$info->email) redirect()->back();
            $pdf = PDF::loadView('payment.viewok', compact('info', 'payment', 'student'))->save($filename);

            Mail::queue(new ClientMail($info,$filename,$toMails));
            if(!Mail::failures()){
                unlink($filename);
            }
        }

        return redirect()->back();
    }
}