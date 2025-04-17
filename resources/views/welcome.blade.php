@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Message de bienvenue --}}
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold">Bienvenue sur hbshoop</h1>
        <p class="lead">Découvrez nos produits et profitez des meilleures offres !</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Voir les produits</a>
    </div>

    {{-- Nouveaux produits --}}
    <h2 class="mb-4 text-center">Nouveautés</h2>
    <div class="row mb-5">
        @foreach($latestProducts as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-light">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                    <p class="font-weight-bold">{{ $product->price }} DT</p>
                    <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Témoignages clients --}}
    <h2 class="mb-4 text-center">Avis Clients</h2>
    <div class="row mb-5">
        <div class="col-md-4">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Super service et produits de qualité !</p>
                <footer class="blockquote-footer">Meriem K.</footer>
            </blockquote>
        </div>
        <div class="col-md-4">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Livraison rapide et excellent support.</p>
                <footer class="blockquote-footer">Ali B.</footer>
            </blockquote>
        </div>
        <div class="col-md-4">
            <blockquote class="blockquote text-center">
                <p class="mb-0">Très bon rapport qualité/prix.</p>
                <footer class="blockquote-footer">Ines D.</footer>
            </blockquote>
        </div>
    </div>

    {{-- Zone de confiance --}}
    <h2 class="mb-4 text-center">Pourquoi choisir hshoop ?</h2>
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <i class="bi bi-shield-lock fs-1 text-primary"></i>
            <p class="mt-2">Paiement sécurisé</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-truck fs-1 text-success"></i>
            <p class="mt-2">Livraison rapide</p>
        </div>
        <div class="col-md-4">
            <i class="bi bi-headset fs-1 text-warning"></i>
            <p class="mt-2">Support client 24/7</p>
        </div>
    </div>

</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .blockquote {
        border-left: 5px solid #007bff;
        padding-left: 15px;
        margin: 20px 0;
    }
</style>
@endsection