@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Ajouter un produit</h2>
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.products.form')
        <button class="btn btn-primary">Enregistrer</button>

       

    </form>
</div>
@endsection
