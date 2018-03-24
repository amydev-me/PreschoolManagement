<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:39 PM
 */

namespace Data\Actions\Category;


use Data\Actions\Action;
use Data\Repositories\CategoryRepository;

class BaseCategoryAction extends Action
{
    public function __construct(CategoryRepository $repository,$request = null)
    {
        parent::__construct($request);
        $this->repository=$repository;
    }
    protected  function perform()
    {
        // TODO: Implement perform() method.
    }
}