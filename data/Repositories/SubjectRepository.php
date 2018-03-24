<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 10:52 PM
 */

namespace Data\Repositories;


use Data\Models\Subject;

class SubjectRepository extends Repository
{
    function model()
    {
        return Subject::class;
    }

    public function getData($pages)
    {
        return Subject::orderByDesc('id')->paginate($pages);
    }

    public function getByNameWithPaginate($value, $attribute, $pages)
    {
        return Subject::where($attribute, 'LIKE', $value . '%')->orderByDesc('id')->paginate($pages);
    }

    public function asyncGetData()
    {
        return Subject::orderBy('subjectName')->get();
    }
}