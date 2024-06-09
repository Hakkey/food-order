<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('user.index', compact('menus'));
    }
}
