<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:12 AM
 */

namespace Data\Actions\Grade;


use Data\Models\Grade;
use Data\Models\Term;
use Data\Repositories\GradeRepository;
use Data\Repositories\TermRepository;

class UpdateGrade extends BaseGradeAction
{
    private $termRepo;
    public function __construct(GradeRepository $repository, TermRepository $termRepository, $request = null)
    {
        parent::__construct($repository, $request);
        $this->termRepo = $termRepository;
    }

    public function perform()
    {
        $_grade = $this->request()['grade'];
        $grade = Grade::where('id', $_grade['id'])->first();
        if ($grade) {
            $this->repository->update($this->request()['grade'], $_grade['id']);
            $this->termRepo->updaeterm($this->request()['first_full']);
            $this->termRepo->updaeterm($this->request()['first_half']);
            $this->termRepo->updaeterm($this->request()['second_full']);
            $this->termRepo->updaeterm($this->request()['second_half']);
            return true;
        }

        return false;
    }
}