<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:50 PM
 */

namespace Data\Actions\Category;


class DeleteCategory extends BaseCategoryAction
{
    public function perform()
    {
        $category = $this->repository->delete($this->request());
        if ($category) {
            return true;
        }
        return false;
    }
}