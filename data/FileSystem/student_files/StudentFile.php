<?php

namespace Data\FileSystem\student_files;


use Data\FileSystem\AbstractFileSystem;

class StudentFile extends AbstractFileSystem
{
    public function __construct($file)
    {
        parent::__construct($file);
        $this->path = 'other/students';
    }
}