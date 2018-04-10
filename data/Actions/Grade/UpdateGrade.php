<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:12 AM
 */

namespace Data\Actions\Grade;


use Data\Models\Grade;
use Data\Repositories\GradeRepository;

class UpdateGrade extends BaseGradeAction
{
    public function __construct(GradeRepository $repository, $request = null)
    {
        parent::__construct($repository, $request);

    }

    public function perform()
    {
        $_grade = $this->request()['grade'];

        $grade = Grade::where('id', $_grade['id'])->first();

        if ($grade) {
            $this->repository->update( $this->request()['grade'], $_grade['id']);
            $grade->terms()->detach();
            $grade->terms()->attach( $this->request()['terms']);
            return true;
        }
        return false;
    }
}