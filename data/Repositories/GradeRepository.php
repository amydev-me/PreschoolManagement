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

    public function getGradeByAcademicYear($academic_id, $category_id)
    {
        Grade::where('academic_id', $academic_id)->where('category_id', $category_id)->get();
    }
}