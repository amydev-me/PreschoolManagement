<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 12:58 PM
 */

namespace Data\Actions\BusinessInfo;


use Data\Actions\Action;
use Data\Repositories\InfoRepository;


class BaseBusinessInfoAction extends Action
{
    public function __construct(InfoRepository $repository,$request=null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }

    protected function perform(){}
}