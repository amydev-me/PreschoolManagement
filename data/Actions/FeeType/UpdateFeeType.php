<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 7:42 PM
 */

namespace Data\Actions\FeeType;


class UpdateFeeType extends BaseFeeAction
{
    public function perform()
    {
        $data = $this->repository->update($this->request(), $this->request()['id']);
        if ($data) {
            return true;
        }
        return false;
    }
}