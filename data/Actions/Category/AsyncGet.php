<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:52 PM
 */

namespace Data\Actions\Category;


class AsyncGet extends BaseCategoryAction
{
    protected function perform()
    {
        $categories = $this->repository->asyncGetData();
        return $categories;
    }
}