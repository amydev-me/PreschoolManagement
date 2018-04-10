<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 4:55 PM
 */
namespace Data\Actions\Term;

use Data\Actions\Action;
use Data\Repositories\TermRepository;

class BaseTermAction extends Action
{
    public function __construct(TermRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform()
    {

    }
}