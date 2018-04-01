<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 09/02/2018
 * Time: 4:31 PM
 */

namespace Data\FileSystem\Images;

use Data\FileSystem\AbstractFileSystem;

class TeacherImage extends AbstractFileSystem
{
    public function __construct($file)
    {
        parent::__construct($file);
        $this->path = 'datafiles/images/teachers';
    }

    public function defaultImage(){
        return public_path('/img/default.png');
    }
}