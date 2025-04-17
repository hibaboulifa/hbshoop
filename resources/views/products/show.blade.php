@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">

        <!-- Image produit -->
        <div class="col-md-6 mb-4">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
            @else
                <img src="{{ asset('images/default-product.png') }}" alt="Image par défaut" class="img-fluid rounded shadow" style="max-height: 400px; object-fit: cover;">
            @endif
        </div>

        <!-- Détail produit -->
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <p class="text-muted">{{ $product->description }}</p>
            <p><strong class="h4 text-success">{{ $product->price }} DT</strong></p>

            <!-- Formulaire d'ajout au panier -->
            <form method="POST" action="{{ route('cart.add') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="price" value="{{ $product->price }}">

                <div class="form-group">
                    <label for="quantity">Quantité :</label>
                    <input type="number" name="quantity" value="1" min="1" class="form-control w-25">
                </div>

                <button type="submit" class="btn btn-success mt-3">
                    <i class="bi bi-cart-plus"></i> Ajouter au panier
                </button>
            </form>
        </div>

    </div>

    <!-- Recommandations -->
    <div class="mt-5">
        <h4>Produits similaires</h4>
        <div class="row">
            @forelse($recommendations as $recommended)
                <div class="col-md-3">
                    <div class="card mb-4 h-100">
                        @if($recommended->image)
                            <img src="{{ asset('storage/' . $recommended->image) }}" class="card-img-top" alt="{{ $recommended->name }}" style="height: 180px; object-fit: cover;">
                        @else
                            <img src="{{ asset('images/default-product.png') }}" class="card-img-top" alt="Image par défaut" style="height: 180px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $recommended->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($recommended->description, 50) }}</p>
                            <p><strong>{{ $recommended->price }} DT</strong></p>
                            <a href="{{ route('products.show', $recommended->id) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Aucun produit recommandé.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
