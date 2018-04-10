<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 5:03 PM
 */

namespace Data\Repositories;


use Data\Models\Grade;
use Data\Models\Term;

class TermRepository extends Repository
{
    function model()
    {
      return Term::class;
    }

    public function getData($academic_id){
        return Term::with('academic','category')->where('academic_id',$academic_id)->get();
    }

    public function getByCategory($param){
        return Term::
            where('academic_id',$param['academic_id'])
            ->where('category_id',$param['category_id'])
            ->get();
    }
}