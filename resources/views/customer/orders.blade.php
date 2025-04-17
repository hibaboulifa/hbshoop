@extends('layouts.app')

@section('content')
<div class="container my-5">

    {{-- ✅ Alerte points gagnés (si session contient un message) --}}
    @if(session('points_gagnes'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="bi bi-gift me-2 fs-4"></i>
            <div>
                🎉 Vous avez gagné <strong>{{ session('points_gagnes') }} points</strong> de fidélité. Merci pour votre commande !
            </div>
        </div>
    @endif

    <h2 class="mb-4 text-dark"><i class="bi bi-receipt fs-4 me-2"></i>Historique de mes commandes</h2>

    @forelse($orders as $order)
        <div class="card shadow-sm border-0 mb-4 rounded-4 overflow-hidden">
            <div class="card-header bg-dark text-white d-flex justify-content-between flex-column flex-md-row">
                <div class="mb-2 mb-md-0">
                    <strong>Commande #{{ $order->id }}</strong><br>
                    <small><i class="bi bi-calendar-event"></i> {{ $order->created_at->format('d/m/Y H:i') }}</small>
                </div>
                <div class="text-md-end">
                    <span class="badge bg-light text-dark fs-6 px-3 py-2">
                        Total : {{ number_format($order->total, 2) }} DT
                    </span><br>
                    <a href="{{ route('customer.invoice', $order->id) }}" class="btn btn-sm btn-outline-success mt-2" target="_blank">
                        <i class="bi bi-file-earmark-arrow-down"></i> Facture PDF
                    </a>
                </div>
            </div>

            <div class="card-body bg-white">
                <div class="row row-cols-1 row-cols-md-2 g-3">
                    @foreach($order->items as $item)
                        <div class="col">
                            <div class="d-flex align-items-center border rounded p-3 shadow-sm bg-light h-100">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="me-3 rounded" width="60" height="60">
                                @else
                                    <img src="{{ asset('images/default-product.png') }}" alt="Image par défaut" class="me-3 rounded" width="60" height="60">
                                @endif
                                <div>
                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                    <small class="text-muted d-block">Quantité : <strong>{{ $item->quantity }}</strong></small>
                                    <small class="text-muted d-block">Prix unitaire : {{ number_format($item->price, 2) }} DT</small>
                                    <small class="text-muted">Sous-total : {{ number_format($item->quantity * $item->price, 2) }} DT</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">
            <i class="bi bi-info-circle"></i> Aucune commande pour le moment.
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-success">
            <i class="bi bi-bag"></i> Voir les produits
        </a>
    @endforelse
</div>
@endsection
