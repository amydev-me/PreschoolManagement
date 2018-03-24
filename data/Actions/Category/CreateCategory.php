<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:40 PM
 */

namespace Data\Actions\Category;


class CreateCategory extends BaseCategoryAction
{
    protected function perform()
    {
        $category = $this->repository->create($this->request());
        if ($category) {
            return true;
        }
        return false;
    }
}