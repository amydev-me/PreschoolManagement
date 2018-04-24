<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 05/04/2018
 * Time: 11:28 PM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\Term\CreateTerm;
use Data\Actions\Term\DeleteTerm;
use Data\Actions\Term\GetByGrade;
use Data\Actions\Term\GetTermByCategory;
use Data\Actions\Term\GetTerms;
use Data\Actions\Term\UpdateTerm;
use Data\Repositories\TermRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermController extends Controller
{
    private $repository;

    public function __construct(TermRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('term.index');
    }

    public function create(Request $request)
    {
        $rules = [
            'academic_id' => 'required',
            'category_id' => 'required',
            'termName' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'due_date' => 'required',
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new CreateTerm($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function update(Request $request)
    {
        $rules = [
            'id' => 'required',
            'academic_id' => 'required',
            'category_id' => 'required',
            'termName' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'due_date' => 'required',
        ];

        $validatedata = validator($request->all(), $rules);
        if ($validatedata->fails()) {
            return response()->json([$validatedata->errors()], 422);
        }
        $action = new UpdateTerm($this->repository, $request->all());
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getData()
    {
        $academic = Session::get('academic');

        if ($academic) {
            $term = (new GetTerms($this->repository, ['academic_id' => $academic->id]))->invoke();
            return response()->json(['terms' => $term, 'academic' => $academic]);
        }
        return response()->json(['terms' => [], 'academic' => null]);
    }

    public function getByAcademic(Request $request)
    {
        $term = (new GetTerms($this->repository, ['academic_id' => $request->academic_id]))->invoke();
        return response()->json($term);
    }

    public function delete($id)
    {
        $_req = ['id' => $id];
        $action = new DeleteTerm($this->repository, $_req);
        $result = $action->invoke();
        return response()->json(['success' => $result]);
    }

    public function getByCategory(Request $request)
    {
        $term = (new GetTermByCategory($this->repository,$request->all()))->invoke();
        return response()->json($term);
    }
}