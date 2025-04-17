<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Facture commande #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .total { margin-top: 20px; font-size: 18px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Facture - Commande #{{ $order->id }}</h2>
        <p>Date : {{ $order->created_at->format('d/m/Y H:i') }}</p>
        <p>Statut : {{ ucfirst($order->status) }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->price }} DT</td>
                    <td>{{ $item->quantity * $item->price }} DT</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <strong>Total général : {{ $order->total }} DT</strong>
    </div>
</body>
</html>
