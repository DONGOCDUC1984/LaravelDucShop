<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        // The following has to include paginate(1)
        // Otherwise,there will be errors.
        $orders = Order::paginate(1);
        return view('orders.index', compact("orders"));
    }
    // Store product Data
    public function store(Request $request)
    {

        $products = Product::all();
        //Show cart in right offcanvas
        $cart = Product::where('cart', 1)->get();
        //Show total amount of money in right offcanvas
        $totalmoney = 0;
        foreach ($products as $val) {
            if ($val->cart == 1) {
                $totalmoney += $val->price * $val->cart_quantity;
            }
        }

        $formFields = $request->validate([
            'tel' => 'required',
            "address" => 'required',
        ]);
        $formFields['cart'] = json_encode($cart);
        $formFields['totalmoney'] = $totalmoney;
        $formFields['user_id'] = Auth::user()->id;
        $formFields['user_name'] = Auth::user()->name;
        Order::create($formFields);

        return redirect('/products')->with(
            "status",
            "Order was created successfully! "
        );
    }

    // Delete order
    public function destroy($id)
    {

        $order = Order::find($id);
        // Make sure logged in user is user and not Admin
        if (
            $order->user_id != auth()->id()
            && Auth::user()->isAdmin == 0
        ) {
            abort(403, 'Unauthorized Action');
        }

        $order->delete();

        return redirect('/products')->with(
            "status",
            "Order was deleted successfully! "
        );
    }

    // Manage orders
    public function manage()
    {
        // The following has to include ->paginate(1)
        // Otherwise,there will be errors.
        $orders = Order::where("user_id", Auth::user()->id)
            ->paginate(1);
        return view('orders.manage', compact("orders"));
    }
}
