<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:12 AM
 */

namespace Data\Actions\Grade;


use Data\Repositories\GradeRepository;
use Data\Repositories\TermRepository;

class CreateGrade extends BaseGradeAction
{
    private $termRepo;

    public function __construct(GradeRepository $repository, TermRepository $termRepository, $request = null)
    {
        parent::__construct($repository, $request);
        $this->termRepo = $termRepository;
    }

    protected function perform()
    {
        $_grade = $this->request()['grade'];
        $success = $this->repository->create($_grade);
        if ($success) {
            $_firstFull = $this->request()['firstfull_term'];
            $_firstHalf = $this->request()['firsthalf_term'];
            $_secondFull = $this->request()['secondfull_term'];
            $_secondHalf = $this->request()['secondhalf_term'];
            $_firstFull['grade_id'] = $success['id'];
            $_firstHalf['grade_id'] = $success['id'];
            $_secondFull['grade_id'] = $success['id'];
            $_secondHalf['grade_id'] = $success['id'];
            $this->termRepo->create($_firstFull);
            $this->termRepo->create($_firstHalf);
            $this->termRepo->create($_secondFull);
            $this->termRepo->create($_secondHalf);
            return true;
        }
        return false;
    }
}