<?php
/**
 * Created by PhpStorm.
 * User: Angelo
 * Date: 25/03/2018
 * Time: 10:38 AM
 */

namespace Admin\Http\Controllers;


use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }
}