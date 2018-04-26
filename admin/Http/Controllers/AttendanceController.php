<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 23/04/2018
 * Time: 11:27 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Data\Models\Attendance;
use Data\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index(){
        return view('attendance.index');
    }


    public function create(Request $request){
        $attendance= DB::table('attendances')->insert($request->all());
        return response()->json($attendance);
    }


    public function getAttendance(Request $request){

        $attendances =Attendance::join('grades', 'attendances.grade_id', '=', 'grades.id')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->select('attendances.*', 'students.id', 'students.fullName', 'grades.id')
            ->orderBy('fullName', 'asc')
            ->where('attendances.grade_id',$request->grade_id)->where('attendances.attend_date',$request->filter_date)
            ->get();

//            Attendance::where('grade_id',$request->grade_id)->where('attend_date',$request->filter_date)->get();

        if (count($attendances)>0) {
            return response()->json(['attendances'=>$attendances,'assign'=>true]);
        }else{
            $attendances=Student::where('grade_id',$request->grade_id)->select('id','fullName','grade_id')->get();
            return response()->json(['attendances'=>$attendances,'assign'=>false]);
        }
    }

    public function getAttendanceByGradeTerm(Request $request){

        $attendances =Attendance::join('grades', 'attendances.grade_id', '=', 'grades.id')
            ->join('students', 'attendances.student_id', '=', 'students.id')
            ->select('attendances.*', 'students.id', 'students.fullName', 'grades.id')
            ->orderBy('fullName', 'asc')
            ->where('attendances.grade_id',$request->grade_id)
            ->where('attendances.term_id',$request->term_id)
            ->where('attendances.attend_date',$request->filter_date)
            ->get();

        if (count($attendances)>0) {
            return response()->json(['attendances'=>$attendances,'assign'=>true]);
        }else{
            $attendances=Student::where('grade_id',$request->grade_id)->select('id','fullName','grade_id')->get();
            return response()->json(['attendances'=>$attendances,'assign'=>false]);
        }
    }

    public function attendanceChart($student_id)
    {
        $present= Attendance::where('student_id', $student_id)->where('status','P')->select(DB::raw('count(*) as total'))->first();
        $absence=Attendance::where('student_id', $student_id)->where('status','A')->select(DB::raw('count(*) as total'))->first();
        $leave=Attendance::where('student_id', $student_id)->where('status','L')->select(DB::raw('count(*) as total'))->first();
        return response()->json(['present'=>$present,'absence'=>$absence,'leave'=>$leave]);
    }

    public function getDetail(Request $request){
        $attendances=Attendance::where('student_id', $request->student_id)->where('status',$request->status)->get()->groupBy(['term.termName','attendance_year','attendance_month_name']);

        return response()->json($attendances);
    }
}