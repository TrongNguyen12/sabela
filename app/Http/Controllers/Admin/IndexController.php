<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Product;
use DB;

class IndexController extends Controller
{
    public function getHome()
    {
    	return view('backend.block.home');	
    }
    public function getLogout()
    {
    	Auth::logout();
    	return redirect()->intended('login');
    }
}
