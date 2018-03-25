<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:39 PM
 */

namespace Data\Actions\FeeType;


use Data\Actions\Action;
use Data\Repositories\FeeRepository;

class BaseFeeAction extends Action
{
    public function __construct(FeeRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }
    protected  function perform()
    {

    }
}