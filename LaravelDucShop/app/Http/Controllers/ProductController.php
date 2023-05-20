<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $pagNum = 10;
    private function resetcart()
    {
        $products = Product::all();
        foreach ($products as $val) {
            $val->cart = 0;
            $val->cart_quantity = 1;
            $val->update();
        }
    }
    // All products
    public function index()
    {
        $products = Product::all();
        // Reset cart
        if (!Auth::check()) {
            $this->resetcart();
        }
        //Show cart in right offcanvas
        $cart = Product::where('cart', 1)->get();
        //Show total amount of money in right offcanvas
        $totalmoney = 0;
        foreach ($products as $val) {
            if ($val->cart == 1) {
                $totalmoney += $val->price * $val->cart_quantity;
            }
        }
        return view('products.index', [
            'products' => DB::table('products')
                ->paginate($this->pagNum),
            "cart" => $cart,
            "totalmoney" => $totalmoney,
        ]);
    }

    // Search product
    public function search(Request $request)
    {
        $products = DB::table('products')
            ->where(
                "name",
                "like",
                "%" . strtolower($request->search) . "%"
            )
            ->orWhere(
                "description",
                "like",
                "%" . strtolower($request->search) . "%"
            )
            ->orWhere(
                "type",
                "like",
                "%" . strtolower($request->search) . "%"
            )
            ->paginate($this->pagNum);

        return view(
            'products/index',
            ['products' => $products,]
        );
    }


    // Filter products'type
    public function filtertype($type)
    {
        $products = DB::table('products')
            ->where(
                "type",
                "like",
                "%" . strtolower($type) . "%"
            )
            ->paginate($this->pagNum);

        return view(
            'products/index',
            ['products' => $products,]
        );
    }


    // Filter products'price
    public function filterprice($n1, $n2)
    {
        $products = DB::table('products')
            ->where("price", ">=", $n1)
            ->where("price", "<=", $n2)
            ->paginate($this->pagNum);

        return view(
            'products/index',
            ['products' => $products,]
        );
    }


    // Single product
    public function show($id)
    {
        return view('products/show', ['product' => Product::find($id),]);
    }

    // Create form
    public function create()
    {
        return view('products/create');
    }

    // Store product Data
    public function store(Request $request)
    {

        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'type' => 'required',

        ]);

        if ($request->hasFile('image')) {
            $formFields['image_path'] = $this->storeImage($request);
        }

        Product::create($formFields);

        return redirect('/products')->with(
            "status",
            "Product was created successfully! "
        );
    }

    // Show Edit Form
    public function edit($id)
    {
        $product = Product::find($id);

        return view('products.edit', ['product' => $product]);
    }

    // Update product Data
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $formFields = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'type' => 'required',

        ]);

        if (File::exists($product->image_path)) {
            File::delete($product->image_path);
        }
        if ($request->hasFile('image')) {
            $formFields['image_path'] = $this->storeImage($request);
        }

        $product->update($formFields);

        return redirect('/products')->with(
            "status",
            "Product was updated successfully! "
        );
    }

    // Delete product
    public function destroy($id)
    {

        $product = Product::find($id);

        $product->delete();

        if (File::exists($product->image_path)) {
            File::delete($product->image_path);
        }

        return redirect('/products')->with(
            "status",
            "Product was deleted successfully! "
        );
    }



    // Add to cart
    public function addtocart($id)
    {

        $product = Product::find($id);
        $product->cart = 1;
        $product->update();

        return redirect('/products')->with(
            "status",
            "Product was added to cart successfully! "
        );
    }

    // Decrease cart item's quantity
    public function cartdecreasequan($id)
    {

        $product = Product::find($id);
        $product->cart_quantity -= 1;
        $product->update();

        return redirect('/products')->with(
            "status",
            "Quantity was decreased successfully! "
        );
    }

    // Increase cart item's quantity
    public function cartincreasequan($id)
    {

        $product = Product::find($id);
        $product->cart_quantity += 1;
        $product->update();

        return redirect('/products')->with(
            "status",
            "Quantity was increased successfully! "
        );
    }

    // Remove from cart
    public function removefromcart($id)
    {

        $product = Product::find($id);
        $product->cart = 0;
        $product->update();

        return redirect('/products')->with(
            "status",
            "Product was removed from cart successfully! "
        );
    }

    // End Cart
    // Store Image
    private function storeImage($request)
    {
        $newImageName = time() . "-" . $request->name . "." .
            $request->image->extension();
        return  $request->image->move(
            "uploads/product/",
            $newImageName
        );;
    }
}
