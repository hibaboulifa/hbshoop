@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary"><i class="bi bi-bag-check"></i> Validation de commande</h2>

    @php $total = 0; @endphp

    <div class="table-responsive shadow-sm border rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    @php 
                        $quantity = $cart[$product->id]['quantity'];
                        $price = $cart[$product->id]['price'];
                        $lineTotal = $quantity * $price;
                        $total += $lineTotal;
                    @endphp
                    <tr>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td><span class="badge bg-secondary">{{ $quantity }}</span></td>
                        <td>{{ number_format($price, 2) }} DT</td>
                        <td>{{ number_format($lineTotal, 2) }} DT</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <h4 class="fw-bold">🧾 Sous-total : <span class="text-success">{{ number_format($total, 2) }} DT</span></h4>

        @if(auth()->user()->points >= 100)
            <div class="alert alert-info mt-3">
                <i class="bi bi-gift"></i> ✅ Réduction automatique appliquée : <strong>-10 DT</strong> (100 points utilisés)
            </div>
            <h4 class="fw-bold">💰 Total à payer : <span class="text-danger">{{ number_format(max($total - 10, 0), 2) }} DT</span></h4>
        @endif

        <form method="POST" action="{{ route('checkout.confirm') }}" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">
                <i class="bi bi-check-circle-fill"></i> Confirmer la commande
            </button>
        </form>
    </div>
</div>
@endsection
