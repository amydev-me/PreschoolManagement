<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Data\Repositories\StudentRepository;

class StudentController extends Controller
{
    private $repository;

    public function __construct(StudentRepository $repo)
    {
        $this->repository = $repo;
    }

    public function index()
    {
        return view('student.index');
    }
}