<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:39 PM
 */

namespace Data\Actions\Subject;


use Data\Actions\Action;
use Data\Repositories\CategoryRepository;
use Data\Repositories\SubjectRepository;

class BaseSubjectAction extends Action
{
    public function __construct(SubjectRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }
    protected  function perform()
    {
        // TODO: Implement perform() method.
    }
}