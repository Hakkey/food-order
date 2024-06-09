<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        // Retrieve menu ordered by the latest created
        $menus = Menu::orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('menus.index', compact('menus', 'categories'));
    }

    public function datatable()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();

        return DataTables::of($menus)
        ->addColumn('category', function ($menu) {
            return $menu->category->name;
        })
        ->addColumn('action', function ($menu) {
            return '<a href="'.route('menus.edit', $menu->id).'" class="btn btn-sm btn-primary">Edit</a>'.
                   '<button class="btn btn-sm btn-danger" data-id="'.$menu->id.'">Delete</button>';
        })
        ->rawColumns(['action'])
        ->make(true);

        // return response()->json(['data' => $menus]);
    }

    // add all the necessary methods for CRUD operations
    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required', 
            'price' => 'required',
            'image' => 'required',
        ]);

        // Save image to storage
        $image = $request->file('image');
        $image->storeAs('public/images/menus', $image->hashName());

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->category_id = $request->input('category');
        $menu->price = $request->input('price');
        $menu->image = $image->hashName();
        $menu->save();

        //return json response with success message
        return response()->json(['message' => 'Menu created successfully']);

    }

    public function show($id)
    {
        // Add your logic here
    }

    public function edit($id)
    {
        // Add your logic here
    }

    public function update(Request $request, $id)
    {
        // Add your logic here
    }

    public function destroy($id)
    {
        // Add your logic here
    }


}
