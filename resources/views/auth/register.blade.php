@extends('layouts.auth')

@section('content')
    <!-- Intégration du CSS Bootstrap -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #17a2b8;
            height: 100vh;
        }
        #register .container #register-row #register-column #register-box {
            margin-top: 80px;
            max-width: 600px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
            padding: 30px;
        }
        #register .form-group label {
            font-weight: 600;
        }
        #register-link {
            margin-top: 10px;
        }
    </style>

    <div id="register">
        <h3 class="text-center text-white pt-5">Formulaire d'inscription</h3>
        <div class="container">
            <div id="register-row" class="row justify-content-center align-items-center">
                <div id="register-column" class="col-md-6">
                    <div id="register-box" class="col-md-12">
                        <form id="register-form" class="form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <h3 class="text-center text-info">S'inscrire</h3>

                            {{-- Nom complet --}}
                            <div class="form-group">
                                <label for="name" class="text-info">Nom complet :</label><br>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email" class="text-info">Adresse e-mail :</label><br>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mot de passe --}}
                            <div class="form-group">
                                <label for="password" class="text-info">Mot de passe :</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <span class="text-sm text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Confirmation du mot de passe --}}
                            <div class="form-group">
                                <label for="password_confirmation" class="text-info">Confirmer le mot de passe :</label><br>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>

                            {{-- CGU --}}
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">J'accepte les <a href="#">conditions d'utilisation</a></label>
                            </div>

                            {{-- Bouton inscription --}}
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md btn-block" value="S'inscrire">
                            </div>

                            {{-- Lien vers la connexion --}}
                            <div id="register-link" class="text-right">
                                <a href="{{ route('login') }}" class="text-info">Déjà inscrit ? Connecte-toi ici</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
