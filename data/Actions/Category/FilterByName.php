<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:51 PM
 */

namespace Data\Actions\Category;


class FilterByName extends BaseCategoryAction
{
    protected function perform()
    {
        $academics = $this->repository->getByNameWithPaginate($this->request()['categoryName'],'categoryName',$this->pages);
        return $academics;
    }
}