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
        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 320px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }
        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }
        #login .container #login-row #login-column #login-box #login-form #register-link {
            margin-top: -85px;
        }
    </style>

    <div id="login">
        <h3 class="text-center text-white pt-5">Connexion form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h3 class="text-center text-info">Connexion</h3>
                            
                            {{-- Message de session --}}
                            @if (session('status'))
                                <div class="mb-4 px-4 py-2 bg-green-100 text-green-700 rounded-md text-sm font-medium">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email" class="text-info">Adresse e-mail :</label><br>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Mot de passe --}}
                            <div class="form-group">
                                <label for="password" class="text-info">Mot de passe :</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Se souvenir de moi --}}
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Se souvenir de moi</span> 
                                    <input id="remember-me" name="remember" type="checkbox">
                                </label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Se connecter">
                            </div>
                            
                            <div id="register-link" class="text-right">
                                <a href="{{ route('register') }}" class="text-info">Pas encore de compte ? Inscris-toi ici</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
