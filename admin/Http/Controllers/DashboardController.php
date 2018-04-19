<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:38 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Models\Academic;
use Data\Models\Guardian;
use Data\Models\Student;
use Data\Models\Subject;
use Data\Models\Teacher;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        $academic =Session::get('academic');
        $studentcount=0;
        if($academic){
            $studentcount= Student::whereHas('academic',function($q) use($academic){
                $q->where('id',$academic->id);
            })->count();
        }

        $teachercount= Teacher::count();
//        $guardiancount=Guardian::count();
        $subjectcount=Subject::count();
        return view('dashboard.index',compact('studentcount','teachercount','subjectcount'));
    }

    public function yearlyStudents(){

        $batches= Academic::select(['id','academicName'])->orderby('id','asc')->get();
        return response()->json($batches);
    }

    public function yearlyIncome(){
        $batches= Academic::select(['id','academicName'])->orderby('id','asc')->get();
        return response()->json($batches);
    }
}