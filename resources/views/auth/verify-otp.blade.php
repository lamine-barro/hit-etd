<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Vérification OTP</title>
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

        .otp-card {
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

        .otp-header {
            background: var(--primary-color);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .otp-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .otp-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: 5px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: center;
            letter-spacing: 0.5em;
            font-size: 1.5em;
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

        .email-badge {
            background: rgba(255, 107, 0, 0.1);
            color: var(--primary-color);
            padding: 8px 16px;
            border-radius: 20px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .timer {
            color: var(--secondary-color);
            font-size: 0.9em;
            margin-top: 15px;
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
                <div class="otp-card">
                    <div class="logo-container">
                        <img src="{{ asset('logo_hit.png') }}" alt="HIT Logo">
                    </div>
                    <div class="otp-header">
                        <h4>{{ __('Vérification OTP') }}</h4>
                    </div>
                    <div class="otp-body">
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="text-center mb-4">
                            <div class="email-badge">
                                <i class="bi bi-envelope me-2"></i>{{ $email }}
                            </div>
                            <p class="text-muted">Veuillez entrer le code à 6 chiffres envoyé à votre adresse email</p>
                        </div>

                        <form method="POST" action="{{ route('login.verify-otp') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">

                            <div class="mb-4">
                                <input id="otp" type="text" 
                                    class="form-control @error('otp') is-invalid @enderror" 
                                    name="otp" 
                                    required 
                                    autofocus 
                                    maxlength="6" 
                                    pattern="\d{6}"
                                    autocomplete="off"
                                    placeholder="------">

                                @error('otp')
                                    <div class="invalid-feedback d-block text-center">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-shield-check me-2"></i>
                                    {{ __('Vérifier le code') }}
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <div class="timer mb-3">
                                <i class="bi bi-clock me-1"></i>
                                Le code expire dans <span id="timer">05:00</span>
                            </div>
                            <a href="{{ route('login') }}" class="back-link text-decoration-none">
                                <i class="bi bi-arrow-left me-1"></i>
                                {{ __('Retour à la connexion') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Timer countdown
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var countdown = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(countdown);
                    display.textContent = "Expiré";
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = 60 * 5,
                display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);
        };

        // Format OTP input
        document.getElementById('otp').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 6);
        });
    </script>
</body>
</html> 