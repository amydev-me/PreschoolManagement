<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 07/04/2018
 * Time: 10:33 PM
 */

namespace Data\Actions\Grade;


use Data\Repositories\GradeRepository;
use Data\Repositories\SectionRepository;

class GetGradeDetail extends BaseGradeAction
{


    public function __construct(GradeRepository $repository, $request = null)
    {
        parent::__construct($repository, $request);

    }

    protected function perform()
    {
        return $this->repository->getGradeDetail($this->request()['grade_id']);
    }
}