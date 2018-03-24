<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 19/03/2018
 * Time: 1:37 PM
 */

namespace Data\FileSystem\Images;


use Data\FileSystem\AbstractFileSystem;

class BusinessImage extends AbstractFileSystem
{
    public function __construct($file)
    {
        parent::__construct($file);
        $this->path = 'images/business';
    }
}