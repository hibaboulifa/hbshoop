<div class="mb-3">
    <label>Nom</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}">
</div>
<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Prix</label>
    <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $product->price ?? '') }}">
</div>
<div class="mb-3">
    <label>Stock</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock ?? '') }}">
</div>
<div class="mb-3">
    <label>Image du produit</label>
    <input type="file" name="image" class="form-control">
</div>

{{-- Affichage de l'image actuelle si en mode édition --}}
@if(isset($product) && $product->image)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $product->image) }}" alt="Image produit" style="max-width: 150px;">
    </div>
@endif