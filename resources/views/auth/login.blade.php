<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #FF6B00;
            --secondary-color: #2c3e50;
            --accent-color: #FF8D3F;
        }
        
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,.05);
            overflow: hidden;
        }

        .logo-container {
            text-align: center;
            padding: 2rem 0;
        }

        .logo-container img {
            height: 60px;
            width: auto;
        }

        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .login-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .login-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 5px;
            padding: 12px;
            border: 1px solid #e0e0e0;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(255, 107, 0, 0.1);
            border-color: var(--primary-color);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--accent-color);
            transform: translateY(-1px);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #e0e0e0;
        }

        .back-link {
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: var(--accent-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    <div class="logo-container">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('logo_hit.png') }}" alt="HIT Logo">
                        </a>
                    </div>
                    <div class="login-header">
                        <h4>{{ __('Administration') }}</h4>
                    </div>
                    <div class="login-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.send-otp') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label">{{ __('Adresse email') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input id="email" type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autocomplete="email" 
                                        autofocus
                                        placeholder="Entrez votre email">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-shield-lock me-2"></i>
                                    {{ __('Recevoir le code OTP') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="back-link text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>
                                {{ __('Retour au site') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 