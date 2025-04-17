@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>

    <canvas id="salesChart" height="100"></canvas>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($sales->pluck('product.name')),
            datasets: [
                {
                    label: 'Ventes passées',
                    data: @json($sales->pluck('total_sales')),
                    backgroundColor: 'blue'
                },
                {
                    label: 'Prédiction (prochaine période)',
                    data: @json($predictions->pluck('predicted_sales')),
                    backgroundColor: 'pink'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<a href="{{ route('admin.export-report') }}" class="btn btn-primary mb-3">Exporter le rapport</a>

<hr class="my-4">
<h4>Statistiques clients</h4>
<table class="table">
    <thead>
        <tr>
            <th>Client</th>
            <th>Email</th>
            <th>Points</th>
            <th>Nombre de commandes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->points }}</td>
                <td>{{ $customer->orders_count }}</td>
           
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
