@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des produits</h2>

    <!-- Formulaire de recherche -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="row align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Recherche par nom..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Nombre de résultats -->
    <div class="mb-3 text-muted">
        Résultats trouvés : {{ $products->total() }}
    </div>

    <!-- Affichage des produits -->
    <div class="row g-4"> {{-- g-4 = espace entre colonnes et lignes --}}
        @forelse($products as $product)
            <div class="col-md-4 d-flex">
                <div class="card shadow-sm rounded-4 w-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top rounded-top-4" alt="{{ $product->name }}" style="max-height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-product.png') }}" class="card-img-top rounded-top-4" alt="Image par défaut" style="max-height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <p class="card-text"><strong>{{ $product->price }} DT</strong></p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Détails</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Aucun produit ne correspond à votre recherche.</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>
</div>
@endsection
