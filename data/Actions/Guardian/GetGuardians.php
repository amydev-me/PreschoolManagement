<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 1:46 PM
 */

namespace Data\Actions\Guardian;


class GetGuardians extends BaseGuardianAction
{
    public function perform()
    {
        return $this->repository->getData($this->pages);
    }
}