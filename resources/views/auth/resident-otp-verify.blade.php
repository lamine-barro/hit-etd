<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Vérification - {{ config('app.name', 'Hub Ivoire Tech') }}</title>
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-orange-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo Hub Ivoire Tech cliquable -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block hover:scale-105 transition-transform duration-200">
                <img src="{{ asset('logo_hit.png') }}" alt="Hub Ivoire Tech" class="h-16 w-auto mx-auto mb-6">
            </a>
            
            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gradient-to-br from-green-100 to-green-200 shadow-lg">
                <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                Code envoyé !
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Vérifiez votre boîte mail et saisissez le code reçu
            </p>
            <p class="mt-1 text-center text-xs text-gray-500">
                Email : <span class="font-medium">{{ $email }}</span>
            </p>
        </div>
        
                 <form class="mt-8 space-y-6" method="POST" action="{{ route('resident.otp.verify.submit') }}">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            
            @if ($errors->any())
                <div class="rounded-xl bg-red-50 border border-red-200 p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                {{ $errors->first() }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($message))
                <div class="rounded-xl bg-green-50 border border-green-200 p-4 shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">
                                {{ $message }}
                            </h3>
                        </div>
                    </div>
                </div>
            @endif

            <div class="space-y-6">
                <div>
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">Code de vérification</label>
                    <input id="otp" 
                           name="otp" 
                           type="text" 
                           maxlength="6"
                           pattern="[0-9]{6}"
                           autocomplete="one-time-code" 
                           required 
                           class="appearance-none rounded-xl relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:z-10 shadow-sm transition duration-200 text-center text-2xl tracking-widest" 
                           placeholder="000000"
                           autofocus>
                    <p class="mt-2 text-xs text-gray-500 text-center">Le code expire dans 5 minutes</p>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-lg hover:shadow-xl transition duration-200 transform hover:scale-[1.02]">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-orange-300 group-hover:text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Vérifier et se connecter
                </button>
            </div>
            
            <!-- Lien retour -->
            <div class="text-center">
                <a href="{{ route('resident.otp.login') }}" class="text-sm text-gray-600 hover:text-orange-600 transition duration-200 flex items-center justify-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Renvoyer un nouveau code</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        // Auto-focus et formatage du champ OTP
        document.getElementById('otp').addEventListener('input', function(e) {
            // Garder seulement les chiffres
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Soumettre automatiquement si 6 chiffres
            if (this.value.length === 6) {
                this.form.submit();
            }
        });
        
        // Auto-focus au chargement
        document.getElementById('otp').focus();
    </script>
</body>
</html> 