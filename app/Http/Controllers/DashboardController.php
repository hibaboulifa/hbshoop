<?php
namespace App\Http\Controllers;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderItem;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        // Ventes par produit
        $sales = OrderItem::selectRaw('product_id, SUM(quantity) as total_sales')
                          ->groupBy('product_id')
                          ->with('product')
                          ->get();
    
        $predictions = $sales->map(function ($sale) {
            $sale->predicted_sales = $sale->total_sales * 1.1;
            return $sale;
        });
    
        // Statistiques clients
        $customers = Customer::withCount('orders')->get(); // besoin de la relation orders()
        $customers = User::where('role', 'customer') // si tu as un champ 'role' dans ta table users
        ->withCount('orders')
        ->get();
        return view('admin.dashboard', compact('sales', 'predictions', 'customers'));
    }
    public function exportPDF()
{
    $sales = OrderItem::selectRaw('product_id, SUM(quantity) as total_sales')
                      ->groupBy('product_id')
                      ->with('product')
                      ->get();

    return Pdf::loadView('admin.report', compact('sales'))
              ->download('rapport_ventes.pdf');
}
}
