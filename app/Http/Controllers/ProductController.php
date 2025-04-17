<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Affiche la liste de tous les produits
    public function index(Request $request)
    {
        $query = Product::query();
    
        // Filtrage par recherche (nom du produit)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Pagination avec 9 produits par page
        $products = $query->paginate(9);
    
        return view('products.index', compact('products'));
    }

    // Affiche les détails d'un produit spécifique
    public function show($id)
    {
        // Trouver le produit par son ID ou échouer si non trouvé
        $product = Product::findOrFail($id);

        // Recommandations simples : autres produits aléatoires
        $recommendations = Product::where('id', '!=', $id)
                                    ->inRandomOrder()
                                    ->take(4)
                                    ->get();

        return view('products.show', compact('product', 'recommendations'));
    }
  

    

}
