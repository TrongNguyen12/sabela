<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuGroup;

class MenuController extends Controller
{
    public function getMenuGroup()
    {
    	$data = MenuGroup::all();
    	return view('backend.menu.list-group', compact('data'));
    }
}
