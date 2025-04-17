<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\LoyaltyReward;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $customer = \App\Models\User::findOrFail(Auth::id());


        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['quantity'] * $item['price'];
            }

            // Gestion des points et réduction
            $discount = 0;
            if ($customer->points >= 100) {
                $discount = 10;
                $customer->decrement('points', 100);
            }

            $finalTotal = max($total - $discount, 0);

            // Création de la commande
            $order = Order::create([
                'customer_id' => $customer->id,
                'total' => $finalTotal,
                
            ]);

            // Création des éléments de commande
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Ajout de points fidélité
            $pointsEarned = floor($finalTotal / 10);
            $customer->increment('points', $pointsEarned);

            // Notification fidélité (optionnelle)
            if ($customer->points >= 500) {
                $customer->notify(new \App\Notifications\LoyaltyReward());
            }

            // Vider le panier
            session()->forget('cart');

            DB::commit();

            return redirect()->route('orders.index')
                             ->with('success', 'Commande validée. Points gagnés : ' . $pointsEarned);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Erreur lors du checkout : ' . $e->getMessage());
        }
    }
}
