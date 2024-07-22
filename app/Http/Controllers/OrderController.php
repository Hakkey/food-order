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

    public function payment($id, Request $request)
    {
        $order = Order::find($id);
        return view('user.order.payment', ['order' => $order]);
    }

    public function receipt($id, Request $request)
    {
        $order = Order::find($id);
        return view('user.order.receipt', ['order' => $order]);
    }

    public function loading(Request $request)
    {
        $order = json_decode($request->query('order'), true);
        return view('user.order.loading', ['order' => $order]);
    }

    public function orderTemplate(Request $request)
    {
        $template_id = $request->input('template_id');
        $template = Template::find($template_id);

        $order = new Order;
        $order->phone_number = $template->phone_number;
        $order->table = $template->table;
        $order->order_type = $template->order_type;
        $order->items = $template->items;
        $order->save();


        return response()->json(['message' => 'Order saved successfully', 'order' => $order, 'order_id' => $order->id]);
        // return view('user.order.order-template', ['template' => $template, 'order' => $order, 'order_id' => $order->id]);
    }

    public function save(Request $request)
    {
        $order = json_decode($request->input('order'), true);

        // Assuming you have an Order model
        $newOrder = new Order;
        $newOrder->phone_number = $request->input('phone');
        $newOrder->table = $request->input('table');
        $newOrder->order_type = $request->input('order_type');
        $newOrder->items = json_encode($order);
        // $newOrder->items = $order; // You might need to adjust this depending on your database structure
        $newOrder->save();

        // return newly created order id
        return response()->json(['message' => 'Order saved successfully', 'order' => $order, 'order_id' => $newOrder->id]);
        

        // redirect to the payment page
        // return response()->json(['message' => 'Order saved successfully', 'order' => $order]);


        // return response()->json(['message' => 'Order saved successfully']);
    }

    public function checkTemplate(Request $request)
    {
        $phone = $request->input('phone');
        $templates = Template::where('phone_number', $phone)->get();

        if ($templates) {
            return response()->json(['status' => 'found', 'templates' => $templates]);
        }

        return response()->json(['message' => 'Template not found']);
    }

    public function saveTemplate(Request $request)
    {
        $order = $request->input('order');
        $phone = $request->input('phone');
        $template_name = $request->input('template_name');
        $table_id = $request->input('table_id');

        $order = Order::find($table_id);

        // Assuming you have a Template model
        $newTemplate = new Template;
        $newTemplate->phone_number = $order->phone_number; 
        $newTemplate->name = $template_name;
        $newTemplate->items = $order->items;
        $newTemplate->table = $order->table;
        $newTemplate->order_type = $order->order_type;
        $newTemplate->save();

        return response()->json(['message' => 'Template saved successfully', 'order' => $order, 'phone' => $phone, 'template_name' => $template_name]);
    }

    public function updateStatus(Request $request)
    {
        $order = Order::find($request->input('orderId'));
        $order->status = $request->input('status');
        $order->total = $request->input('total');
        $items = $request->input('items');
        $order->items = json_encode($items);

        $order->save();

        return response()->json(['message' => 'Order status updated successfully']);
    }

    public function status(Request $request)
    {
        $id = $request->input('order_id');
        $order = Order::find($id);
        
        // dd($order->status);
        
        // return payment view


        // return view('user.order.payment', ['order' => $order]);

        return response()->json(['status' => $order->status]);
    }
}
