<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 24/03/2018
 * Time: 5:18 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Category\AsyncGet;
use Data\Actions\Category\CreateCategory;
use Data\Actions\Category\DeleteCategory;
use Data\Actions\Category\FilterByName;
use Data\Actions\Category\GetCategories;
use Data\Actions\Category\UpdateCategory;
use Data\Models\Category;
use Data\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('category.index');
    }

    public function getData()
    {
        $action = new GetCategories($this->repository);
        $result = $action->invoke();

        return response()->json($result);
    }

    public function create(Request $request)
    {

        $action = new CreateCategory($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $action = new UpdateCategory($this->repository, $request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteCategory($this->repository, $_req);
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return response()->json([$result->errors()], 422);
        }
        return response()->json(['success' => $result]);
    }

    public function filterByName($name)
    {
        $_req['categoryName'] = $name;
        $action = new FilterByName($this->repository, $_req);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function asyncget()
    {
        $action = new AsyncGet($this->repository);
        $result = $action->invoke();
        return response()->json($result);
    }

    public function getCategoryWithGrade()
    {
        $academic = Session::get('academic');
        if($academic){
            $categories = Category::with(['grades' => function ($q) use($academic) {
                $q->where('academic_id', $academic->id)->get();
            }])->get();
            return response()->json(['grades' => $categories, 'active_academic' => $academic]);
        }
        return response()->json(['grades' => [], 'active_academic' => null]);
    }

    public function getCategoryWithGradeByAcademic($academic_id){
        $categories = Category::with(['grades' => function ($q) use($academic_id) {
            $q->where('academic_id', $academic_id)->get();
        }])->get();
        return response()->json($categories);
    }
}