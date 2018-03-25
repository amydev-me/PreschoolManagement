<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 4:55 PM
 */
namespace Data\Actions\Term;

use Data\Actions\Action;

class BaseTermAction extends Action
{
    public function __construct($request = null)
    {
        parent::__construct($request);
    }

    protected function perform()
    {

    }
}