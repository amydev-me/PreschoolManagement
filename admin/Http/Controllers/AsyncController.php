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
use Data\Repositories\AcademicYearRepository;
use Data\Repositories\CategoryRepository;

class AsyncController extends Controller
{
    private $academicRepository, $categoryRepository;

    public function __construct(AcademicYearRepository $academicRepository, CategoryRepository $categoryRepository)
    {
        $this->academicRepository = $academicRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function asyncAcademicAndCategory()
    {
        $action = new ActiveAcademic($this->academicRepository);
        $active_academic = $action->invoke();
        $academicAction = new AcademicAsyncGet($this->academicRepository);
        $academics = $academicAction->invoke();
        $categoryAction = new CategoryAsyncGet($this->categoryRepository);
        $categories = $categoryAction->invoke();
        return response()->json(['academics' => $academics, 'categories' => $categories, 'active' => $active_academic]);
    }
}