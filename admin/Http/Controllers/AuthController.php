<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 27/03/2018
 * Time: 11:11 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;
use Data\Actions\User\UserLogin;
use Data\Models\BusinessInfo;



use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{

    public function index(){
        $info= BusinessInfo::first();
        return view('login.login',compact('info'));
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
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}