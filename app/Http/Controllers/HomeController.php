<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function orders()
    {
        $orders = Order::where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->get();
        return view('orders')->with('orders', $orders);
    }

    public function completed()
    {
        $orders = Order::where('status', 'completed')->get();
        return view('completed')->with('orders', $orders);
    }
}
