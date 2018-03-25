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
}