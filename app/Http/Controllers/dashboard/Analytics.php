<?php

namespace App\Http\Controllers\dashboard;
use App\Models\Order;
use App\Models\MenuItem;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
            // Fetch latest orders, limit to 5 (or adjust as needed)
            $latestOrders = Order::latest()->limit(5)->get();

            // Fetch all menu items
            $menuItems = MenuItem::all();
    
            // Fetch all customers
            $customers = Customer::withCount('orders')->get();

    return view('content.dashboard.dashboards-analytics', compact('latestOrders', 'menuItems', 'customers'));
  }
}
