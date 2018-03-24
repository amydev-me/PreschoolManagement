<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 05/03/2018
 * Time: 10:03 AM
 */

namespace Data\FileSystem\Images;

use Data\FileSystem\AbstractFileSystem;

class StudentImage extends AbstractFileSystem
{
    public function __construct($file)
    {
        parent::__construct($file);
        $this->path = 'images/students';
    }

    public function defaultImage(){
        return public_path('/img/default.png');
    }
}