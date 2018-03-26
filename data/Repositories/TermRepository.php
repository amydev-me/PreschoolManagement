<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 5:03 PM
 */

namespace Data\Repositories;


use Data\Models\Term;

class TermRepository extends Repository
{
    function model()
    {
      return Term::class;
    }

    public function updaeterm($term){

        $_term=Term::where('id',$term['id'])->where('grade_id',$term['grade_id']);

        if ($_term) {
            return ($_term->update($term)) ? $_term : false;
        }
    }
}