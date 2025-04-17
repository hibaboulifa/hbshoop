<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
public function add(Request $request)
{
    $cart = session()->get('cart', []);
    $productId = $request->input('product_id');

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $request->input('quantity');
    } else {
        $cart[$productId] = [
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price')
        ];
    }

    session(['cart' => $cart]);

    return redirect()->back()->with('success', 'Produit ajouté au panier');
}
public function index()
{
    $cart = session()->get('cart', []);
    $products = Product::find(array_keys($cart));

    return view('cart.index', compact('products', 'cart'));
}
}