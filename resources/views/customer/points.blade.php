@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mes points fidélité</h2>

    <p>Vous avez <strong>{{ $points }}</strong> points.</p>

    @if($points >= 500)
        <div class="alert alert-success">
            🎁 Félicitations ! Vous avez débloqué une récompense spéciale.
        </div>
    @elseif($points >= 100)
        <div class="alert alert-info">
            🔄 Vous pouvez utiliser vos points pour une réduction de 10 DT.
        </div>
    @else
        <div class="alert alert-secondary">
            📈 Gagnez des points en passant commande !
        </div>
    @endif
</div>
@endsection
