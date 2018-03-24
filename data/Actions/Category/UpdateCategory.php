<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:42 PM
 */

namespace Data\Actions\Category;


class UpdateCategory extends BaseCategoryAction
{
    public function perform()
    {
        $category = $this->repository->update($this->request(), $this->request()['id']);
        if ($category) {
            return true;
        }
        return false;
    }
}