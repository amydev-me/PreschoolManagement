<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 11:11 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\AcademicYear\ActiveAcademic;
use Data\Actions\User\UserLogin;
use Data\Models\BusinessInfo;


use Data\Repositories\AcademicYearRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    private $academicRepo;
    public function __construct(AcademicYearRepository $academicRepo)
    {
        $this->academicRepo=$academicRepo;
    }

    private function storeActiveAcademic()
    {
        $action = new ActiveAcademic($this->academicRepo);
        $active_academic = $action->invoke();
        Session::put(['academic' => $active_academic]);
    }

    public function index(){
        $info= BusinessInfo::first();
        Session::put(['info'=>$info]);
        return view('login.login');
    }

    public function login(Request $request){
        $action = new UserLogin($request->all());
        $result = $action->invoke();
        if ($result instanceof Validator) {
            return back()->withError('Invalid username or password.');
        }
        if (!$result) {
            return back()->withError('Invalid username or password.');
        }

        $this->storeActiveAcademic();
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}