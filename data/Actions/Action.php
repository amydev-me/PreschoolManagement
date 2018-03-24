<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 1:20 PM
 */

namespace Data\Actions;


abstract class Action
{
    protected $repository;
    protected $request;
    protected $pages=20;
    public function __construct($request=null)
    {
        if ($request != null) {
            $this->request = $request;
        }
    }

    protected function request()
    {
        return $this->request;
    }

    public function invoke(){
        return $this->perform();
    }

    protected abstract function perform();
}