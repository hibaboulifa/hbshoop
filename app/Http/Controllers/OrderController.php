<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_id', Auth::id())
                        ->with('items.product')
                        ->latest()
                        ->get();
    
        return view('customer.orders', compact('orders'));
    }

    // Afficher toutes les commandes du client connecté
    public function customerOrders()
    {
        $customer = Auth::user();

        $orders = Order::where('customer_id', $customer->id)
                        ->with('items.product') // eager loading des produits
                        ->latest()
                        ->get();

        return view('customer.orders', compact('orders'));
    }

    // Afficher les détails d'une commande spécifique
    public function show($id)
    {
        $order = Order::where('id', $id)
                      ->where('customer_id', Auth::id())
                      ->with('items.product')
                      ->firstOrFail();

        return view('customer.order_details', compact('order'));
    }

    // Créer une commande à partir du panier
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            $total = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            // Création de la commande
            $order = Order::create([
                'customer_id' => Auth::id(),
                'total' => $total,
                
            ]);

            // Création des items de la commande
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Vider le panier
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Commande passée avec succès !');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erreur lors de la commande : ' . $e->getMessage());
        }
    }

}
