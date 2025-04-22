<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderQueryMail;

class CartController extends Controller
{
    // VIEW CART
    public function view()
    {
        $cart = session('cart', []);
        $products = Product::findMany($cart);
        return view('cart', compact('products'));
    }

    // ADD TO CART
    public function add($id)
    {
        $cart = session()->get('cart', []);
        $cart[] = $id;
        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart!');
    }

    // SEND ORDER EMAIL
    public function sendQuery(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $cart = session('cart', []);
        $products = Product::findMany($cart);

        if ($products->isEmpty()) {
            return back()->with('error', 'Cart is empty!');
        }

        // Send email to you (admin)
        Mail::to('youremail@example.com')->send(new OrderQueryMail($products, $request->email));

        // Clear cart
        session()->forget('cart');

        return back()->with('success', 'Order query sent! We will contact you soon.');
    }
}
