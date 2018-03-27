<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 11:27 AM
 */

namespace Data\Repositories;


use Data\Models\Student;

class StudentRepository extends Repository
{

    function model()
    {
        return Student::class;
    }
}