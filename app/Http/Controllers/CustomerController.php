<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Affiche les points de fidélité du client connecté
     */
    public function showPoints()
    {
        $customer = Auth::user(); // Ou auth()->user()
        return view('customer.points', ['points' => $customer->points]);
    }
    public function invoice(Order $order)
{
    $pdf = Pdf::loadView('customer.invoice', compact('order'));
    return $pdf->download('facture_commande_' . $order->id . '.pdf');
}
}
