<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 9:56 AM
 */

namespace Data\Repositories;


use Data\Models\Grade;

class GradeRepository extends Repository
{

    function model()
    {
        return Grade::class;
    }

    public function getGradeByAcademicYear($req)
    {
       return Grade::with('academic','category')->where('academic_id', $req['academic_id'])->where('category_id',  $req['category_id'])->get();
    }

    public function getData($academic_id){
        return Grade::with('academic','category')->where('academic_id', $academic_id)->orderByDesc('category_id')->get();
    }

    public function getGradeDetail($grade_id){
        $grade= Grade::with('academic','category')->where('id',$grade_id)->first();
        $sections=$grade->terms()->get();
            return ['grade'=>$grade,'sections'=>$sections];
    }

    public function getGradeOfTerms($grade_id){
        $grade= Grade::where('id',$grade_id)->first();
        if($grade){
            $sections=$grade->terms()->get();
            return $sections;
        }
        return [];
    }
}