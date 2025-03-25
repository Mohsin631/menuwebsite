<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $orders = Order::with('customer')
            ->whereHas('customer', function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%');
                }
            })
            ->get();

        return view('orders.index', compact('orders', 'search'));
    }

    public function create()
    {
        $customers = Customer::all();
        $menus = MenuItem::all();
        return view('orders.create', compact('customers', 'menus'));
    }

    public function store(Request $request)
    {
        $customerId = $request->customer_id;
    
        if (!$customerId) {
            // If no existing customer is selected, create a new one
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|unique:customers',
            ]);
    
            $customer = Customer::firstOrCreate(
                ['phone' => $request->phone],
                [
                    'name' => $request->name,
                    'address' => $request->address
                ]
            );
    
            $customerId = $customer->id; 
        }
    
        // Create the order with the selected or newly created customer
        Order::create([
            'customer_id' => $customerId,
            'menu_item_id' => $request->menu_id,
        ]);
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }
}
