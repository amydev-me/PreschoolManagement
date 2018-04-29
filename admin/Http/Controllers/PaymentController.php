<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/04/2018
 * Time: 11:00 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Payment\CreatePayment;
use Data\Actions\Payment\DeletePayment;
use Data\Actions\Payment\GetPaymentDetail;
use Data\Actions\Payment\UpdatePayment;
use Data\Models\Payment;
use Data\Repositories\PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $repository;

    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(Request $request)
    {
        $action = new CreatePayment($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request){
        $action = new UpdatePayment($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getData()
    {
        $payments = Payment::with(['student' => function ($q) {
            $q->select('id', 'fullName');
        }, 'term' => function ($q) {
            $q->select('id', 'termName');
        }, 'grade'])->orderByDesc('payment_date')->paginate(20);
        return response()->json($payments);
    }

    public function getDetail(Request $request){
        $action=new GetPaymentDetail($this->repository,$request->all());
        $result= $action->invoke();
        return response()->json($result);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeletePayment($this->repository, $_req);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getByStudent(Request $request){
        $student_id=$request->student_id;
        $payments=Payment::with(['student' => function ($q) {
            $q->select('id', 'fullName');
        }, 'term' => function ($q) {
            $q->select('id', 'termName');
        }, 'grade'])->whereHas('student',function($q) use($student_id){
            $q->where('id',$student_id);
        })->get();
        return response()->json($payments);
    }
}