<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(30);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Produit créé avec succès.');
}


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si existante
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
    
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product->update($validated);
    
        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour.');
    }
    

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
    
            // Si le produit est lié à des commandes, on bloque la suppression
            if ($product->orderItems()->exists()) {
                return redirect()->back()->with('error', '❌ Ce produit ne peut pas être supprimé car il est associé à des commandes.');
            }
    
            $product->delete();
    
            return redirect()->back()->with('success', '✅ Produit supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '❌ Une erreur est survenue lors de la suppression.');
        }
    }
    
}
