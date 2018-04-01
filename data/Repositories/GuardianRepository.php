<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 12:36 PM
 */

namespace Data\Repositories;


use Data\Models\Guardian;

class GuardianRepository extends Repository
{

    function model()
    {
       return Guardian::class;
    }
    public function getData($pages)
    {
        return Guardian::orderByDesc('id')->paginate($pages);
    }
    public function getDetail($value, $attribute = 'id', $columns = array('*'))
    {
        return Guardian::where($attribute, '=', $value)->first($columns);
    }

    public function asyncGetData($fullname)
    {
        return Guardian::where('fullName','LIKE',$fullname.'%')->select('id','fullName','email')->orderBy('fullName')->take(10)->get();
    }
}