<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Template;
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

        // Assuming you have an Order model
        $newOrder = new Order;
        // $newOrder->phone_number = $request->input('phone_number');
        $newOrder->table = $request->input('table');
        $newOrder->order_type = $request->input('order_type');
        $newOrder->items = json_encode($order);
        // $newOrder->items = $order; // You might need to adjust this depending on your database structure
        $newOrder->save();

        return response()->json(['message' => 'Order saved successfully']);
    }

    public function saveTemplate(Request $request)
    {
        // dd('asd');
        $order = $request->input('order');
        // dd($order);
        $phone = $request->input('phone');
        $template_name = $request->input('template_name');
        // Now you can use the $order array

        // Assuming you have a Template model
        $newTemplate = new Template;
        $newTemplate->phone_number = $phone; 
        $newTemplate->name = $template_name;
        $newTemplate->items = json_encode($order);
        $newTemplate->save();

        return response()->json(['message' => 'Template saved successfully', 'order' => $order, 'phone' => $phone, 'template_name' => $template_name]);
    }
}
