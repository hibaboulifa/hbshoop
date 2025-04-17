@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Modifier un produit</h2>
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.products.form')
        
        <button class="btn btn-primary">Mettre à jour</button>

        

    </form>
</div>
@endsection
