<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:51 PM
 */

namespace Data\Actions\FeeType;


class FilterByName extends BaseFeeAction
{
    protected function perform()
    {
        $data = $this->repository->getByNameWithPaginate($this->request()['feeName'],'feeName',$this->pages);
        return $data;
    }
}