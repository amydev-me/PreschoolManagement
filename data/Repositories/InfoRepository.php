<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 2:02 PM
 */

namespace Data\Repositories;


use Data\Models\BusinessInfo;

class InfoRepository extends Repository
{
    function model()
    {
        return BusinessInfo::class;
    }

    public function getInfo(){
            return BusinessInfo::first();
    }
}