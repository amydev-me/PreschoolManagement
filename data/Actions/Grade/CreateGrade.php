<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:12 AM
 */

namespace Data\Actions\Grade;


use Data\Repositories\GradeRepository;
use Data\Repositories\SectionRepository;
use Data\Repositories\TermRepository;
use Illuminate\Support\Facades\DB;

class CreateGrade extends BaseGradeAction
{


    public function __construct(GradeRepository $repository, $request = null)
    {
        parent::__construct($repository, $request);

    }

    protected function perform()
    {
        $grade = $this->repository->create($this->request()['grade']);
        if ($grade) {

            foreach ($this->request()['terms'] as $term) {
//                $term['grade_id'] = $grade['id'];
                $grade->terms()->attach($grade->id,['term_id'=>$term['term_id'],'amount'=>$term['amount']]);
//                $this->sectionRepo->create($term);
            }
            return true;
        }
        return false;
    }
}