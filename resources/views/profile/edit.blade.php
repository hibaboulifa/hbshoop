@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4"><i class="bi bi-person-circle"></i> Mon profil</h2>

    {{-- ✅ Message de succès --}}
    @if (session('status') === 'profile-updated')
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i> Profil mis à jour avec succès.
        </div>
    @endif

    {{-- 🔁 Mise à jour du profil --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-pencil-square"></i> Modifier mes informations
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Mettre à jour
                </button>
            </form>
        </div>
    </div>

    {{-- 🔐 Changement de mot de passe --}}
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-warning">
            <i class="bi bi-shield-lock-fill"></i> Changer le mot de passe
        </div>
        <div class="card-body">
            @if (session('status') === 'password-updated')
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i> Mot de passe mis à jour avec succès.
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="current_password" class="form-label">Mot de passe actuel</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-arrow-repeat"></i> Changer le mot de passe
                </button>
            </form>
        </div>
    </div>

    {{-- ❌ Suppression du compte --}}
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <i class="bi bi-trash-fill"></i> Supprimer mon compte
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Es-tu sûr de vouloir supprimer ton compte ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe pour confirmer</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-x-circle"></i> Supprimer mon compte
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
