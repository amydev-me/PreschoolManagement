<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:44 PM
 */

namespace Data\Actions\Category;


class GetCategories extends BaseCategoryAction
{
    public function perform()
    {
        return $this->repository->getData($this->pages);
    }
}