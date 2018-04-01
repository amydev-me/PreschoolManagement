<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 11:27 AM
 */

namespace Data\Repositories;


use Data\Helper\GenerateCodeNo;
use Data\Models\Student;

class StudentRepository extends Repository
{

    function model()
    {
        return Student::class;
    }

    public static function getLastCode()
    {
        return Student::where('studentCode', 'LIKE', GenerateCodeNo::getStudentPrefix() . '%')->orderBy('studentCode', 'desc')->select('studentCode')->first();
    }

    public function removeStudent($model)
    {
        if ($model) {
            return $model->delete();
        }
    }

    public function getStudentDetail($student_id){
      return  Student::with('guardian','terms')->where('id',$student_id)->first();
    }
}