<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 01/04/2018
 * Time: 8:34 PM
 */

namespace Data\Repositories;


use Data\Helper\GenerateCodeNo;
use Data\Models\Teacher;

class TeacherRepository extends Repository
{

    function model()
    {
       return Teacher::class;
    }

    public static  function  getLastCode(){
        return  Teacher::where('teacherCode','LIKE',GenerateCodeNo::getTeacherPrefix() . '%')->orderBy('teacherCode','desc')->select('teacherCode')->first();
    }

    public function removeTeacher($model)
    {
        if ($model) {
            return $model->delete();
        }
    }
    public function getAll($page)
    {
        return Teacher::orderByDesc('created_at')->paginate($page);
    }
}