<?php

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;

use Data\Actions\BusinessInfo\CreateBusinessInfo;
use Data\Actions\BusinessInfo\EditBusinessInfo;
use Data\FileSystem\Images\BusinessImage;
use Data\Models\BusinessInfo;
use Data\Repositories\InfoRepository;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class BusinessInfoController extends Controller
{
    private $repository;
    public function __construct(InfoRepository $repository)
    {
        $this->repository=$repository;
    }

    public function index(){
        return view('business_info.index');
    }

    public function getImage($name)
    {
        $img = new BusinessImage($name);
        return $img->getFileResponse();
    }

    public function create(Request $request){

        $action=new CreateBusinessInfo($this->repository,$request->except('remove'));
        $result=$action->invoke();

        return response()->json(['success' => $result]);
    }

    public function update(Request $request){

        $action=new EditBusinessInfo($this->repository,$request->all(),$request);
        $result=$action->invoke();

        return response()->json(['success' => $result]);
    }

    public function getDetail(){
        $info= BusinessInfo::first();
        return response()->json(['information' => $info]);
    }
}