<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
// use App\Models\Order;

class CartController extends Controller
{

    /**
     * Display the shopping cart view
     *
     * @return \Illuminate\View\View
     */
    public function productCart()
    {
        return view('cart');
    }
    
    /**
     * Add a product to the cart
     *
     * @param int $id
     * @param Request $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart($id, Request $req)
    {
        // Find the product to add to cart
        $product = Product::findOrFail($id);

        // Get the current cart or initialize it as an empty array
        $cart = session()->get('cart', []);

        // Check if the product is already in the cart and update its quantity, or add it to the cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $req->quantity;
        } else {
            $cart[$id] = [
                "image" => $product->image,
                "name" => $product->name,
                "quantity" => $req->quantity,
                "price" => $product->price,
            ];
        }

        // Save the updated cart to the session
        session()->put('cart', $cart);

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }

    /**
     * Update the quantity of a product in the cart
     *
     * @param Request $request
     * @return void
     */
    public function updateCart(Request $request)
    {
        if ($request->id && $request->quantity) {
            // Get the current cart
            $cart = session()->get('cart');

            // Update the quantity of the product with the given ID
            $cart[$request->id]["quantity"] = $request->quantity;

            // Save the updated cart to the session
            session()->put('cart', $cart);

            // Flash a success message
            session()->flash('success', 'Product added to cart.');
        }
    }

    /**
     * Remove a product from the cart
     *
     * @param Request $request
     * @return void
     */
    public function deleteCart(Request $request)
    {
        if ($request->id) {
            // Get the current cart
            $cart = session()->get('cart');

            // Remove the product with the given ID from the cart
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            // Flash a success message
            session()->flash('success', 'Product successfully deleted.');
        }
    }

}
