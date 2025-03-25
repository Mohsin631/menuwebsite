<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|unique:customers',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }


    public function show($id)
    {
        $customer = Customer::with('orders')->findOrFail($id); // Load customer with their orders
        $orders = $customer->orders()->orderBy('created_at', 'desc')->get(); // Get all orders
        $latestOrder = $customer->orders()->latest()->first(); // Get the latest order
        $favoriteOrders = $customer->orders()->where('is_favorite', true)->get(); // Get favorite orders

        return view('customers.show', compact('customer', 'orders', 'latestOrder', 'favoriteOrders'));
    }

}
