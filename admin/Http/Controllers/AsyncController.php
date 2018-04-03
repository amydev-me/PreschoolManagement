<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 2:36 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\AcademicYear\AsyncGet as AcademicAsyncGet;
use Data\Actions\Category\AsyncGet as CategoryAsyncGet;
use Data\Actions\Subject\AsyncGet;
use Data\Repositories\AcademicYearRepository;
use Data\Repositories\CategoryRepository;
use Data\Repositories\SubjectRepository;

class AsyncController extends Controller
{
    private $academicRepository, $categoryRepository,$subjectRepository;

    public function __construct(AcademicYearRepository $academicRepository, CategoryRepository $categoryRepository,SubjectRepository $subjectRepository)
    {
        $this->academicRepository = $academicRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subjectRepository=$subjectRepository;
    }

    private function getActiveAcademic()
    {
        $action = new ActiveAcademic($this->academicRepository);
        $active_academic = $action->invoke();
        return $active_academic;
    }

    private function getAcademics()
    {
        $academicAction = new AcademicAsyncGet($this->academicRepository);
        $academics = $academicAction->invoke();
        return $academics;
    }

    private function getCategories()
    {
        $categoryAction = new CategoryAsyncGet($this->categoryRepository);
        $categories = $categoryAction->invoke();
        return $categories;
    }

    private function getSubjects()
    {
        $categoryAction = new AsyncGet($this->subjectRepository);
        $categories = $categoryAction->invoke();
        return $categories;
    }

    public function asyncAcademicAndCategory()
    {
        $active_academic = $this->getActiveAcademic();
        $academics = $this->getAcademics();
        $categories = $this->getCategories();
        return response()->json(['academics' => $academics, 'categories' => $categories, 'active' => $active_academic]);
    }

    public function asyncActiveAcademicAndCategory()
    {
        $active_academic = $this->getActiveAcademic();
        $categories = $this->getCategories();
        $subjects = $this->getSubjects();
        return response()->json(['categories' => $categories,'subjects'=>$subjects, 'active' => $active_academic]);
    }
}