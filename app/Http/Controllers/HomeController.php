<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function orders()
    {
        $orders = Order::where('status', '!=', 'completed')
                        ->where('status', '!=', 'cancelled')
                        ->whereDate('created_at', today())
                        ->get();
        return view('orders')->with('orders', $orders);
    }

    public function completed()
    {
        //get orders where status is completed or paid
        $orders = Order::where(function ($query) {
            $query->where('status', 'completed')
            ->orWhere('status', 'paid');
        })
        ->whereDate('created_at', today())
        ->get();
        return view('completed')->with('orders', $orders);
    }

    public function allOrders()
    {
        // all order sort by newest date
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('order.index')->with('orders', $orders);
    }
}
