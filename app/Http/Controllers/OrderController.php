<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $foods = Menu::all();
        $categories = Category::with('foods')->get();

        return view('user.order.index2', compact('foods', 'categories'));
    }

    public function payment(Request $request)
    {
        $order = json_decode($request->query('order'), true);
        return view('user.order.payment', ['order' => $order]);
    }

    public function save(Request $request)
    {
        $order = json_decode($request->input('order'), true);
        // Now you can use the $order array

        // Assuming you have an Order model
        $newOrder = new Order;
        $newOrder->items = $order; // You might need to adjust this depending on your database structure
        $newOrder->save();

        return response()->json(['message' => 'Order saved successfully']);
    }
}
