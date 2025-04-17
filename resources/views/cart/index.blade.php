@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-cart4"></i> Mon panier</h2>

    @php $total = 0; @endphp

    @if(empty($cart))
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> Votre panier est vide.
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">Retour à la boutique</a>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produit</th>
                        <th>Image</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @php
                            $quantity = $cart[$product->id]['quantity'];
                            $price = $cart[$product->id]['price'];
                            $subtotal = $quantity * $price;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="60" class="rounded">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}" alt="Image par défaut" width="60" class="rounded">
                                @endif
                            </td>
                            <td>{{ $quantity }}</td>
                            <td>{{ $price }} DT</td>
                            <td><strong>{{ $subtotal }} DT</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <h4 class="fw-bold">Total général : <span class="badge bg-success">{{ $total }} DT</span></h4>
            <a href="{{ route('checkout.index') }}" class="btn btn-success mt-3">
                <i class="bi bi-credit-card"></i> Valider la commande
            </a>
        </div>
    @endif
</div>
@endsection
