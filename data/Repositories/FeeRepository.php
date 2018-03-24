<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 9:08 PM
 */

namespace Data\Repositories;


use Data\Models\Fee;

class FeeRepository extends Repository
{
    function model()
    {
        return Fee::class;
    }

    public function getData($pages)
    {
        return Fee::orderByDesc('id')->paginate($pages);
    }

    public function getByNameWithPaginate($value, $attribute, $pages)
    {
        return Fee::where($attribute, 'LIKE', $value . '%')->orderByDesc('id')->paginate($pages);
    }

    public function asyncGetData()
    {
        return Fee::orderBy('feeName')->get();
    }
}