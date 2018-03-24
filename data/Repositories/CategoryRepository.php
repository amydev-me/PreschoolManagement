<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 5:52 PM
 */

namespace Data\Repositories;


use Data\Models\Category;

class CategoryRepository extends Repository
{

    function model()
    {
        return Category::class;
    }

    public function getData($pages)
    {
        return Category::orderByDesc('id')->paginate($pages);
    }

    public function getByNameWithPaginate($value, $attribute, $pages)
    {
        return Category::where($attribute, 'LIKE', $value . '%')->orderByDesc('id')->paginate($pages);
    }

    public function asyncGetData()
    {
        return Category::orderBy('categoryName')->get();
    }
}