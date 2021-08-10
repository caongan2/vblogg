<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = session()->get('cart');
        $totalCart = [];
        foreach ($carts as $cart) {
            $total = $cart['price'] * $cart['quantity'];
            array_push($totalCart, $total);
        }
        $totalPrice = array_sum($totalCart);
        return view('customer.cart', compact('carts', 'totalPrice'));
    }

    public function addToCart($id)
    {
        $cart = session()->get('cart');
        $product = Product::findorFail($id);
        $product_key = 'product_' . $id;
        if (session()->has($product_key)) {
            Product::where('id', $id)->increment('bought');
            session()->put($product_key, 1);
        }

        if (!$cart) {
            $cart = [
                $id => [
                    'id' => $id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'img' => $product->img
                ]
            ];
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity'] +=1;
            session()->put('cart', $cart);
            return response()->json(['message' => 'success']);
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'img' => $product->img
            ];
        }
        session()->put('cart', $cart);
        $data = ['totalCart' => count((array)session('cart'))];
        return response()->json($data);

    }

    public function destroy($id)
    {
        Product::find($id);
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $data = ['totalCart' => count((array)session('cart'))];
            return response()->json($data);
        }
    }
}
