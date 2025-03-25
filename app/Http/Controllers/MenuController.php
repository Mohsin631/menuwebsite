<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = MenuItem::all();
        return view('menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        MenuItem::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu item created successfully!');
    }

    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu item deleted successfully!');
    }
}
