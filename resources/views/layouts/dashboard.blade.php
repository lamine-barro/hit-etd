<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Administration</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <style>
        [x-cloak] { display: none !important; }
        
        :root {
            --primary-color: #FF6B00;
            --secondary-color: #2c3e50;
            --accent-color: #FF8D3F;
        }
        
        body {
            background-color: #f8f9fa;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
            width: calc(100% - 280px);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background: var(--accent-color);
        }

        .card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,.05);
            border-radius: 10px;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            padding: 1rem;
        }

        .table > :not(caption) > * > * {
            padding: 1rem;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Transitions */
        .fade-enter {
            opacity: 0;
        }
        .fade-enter-active {
            opacity: 1;
            transition: opacity 300ms ease-in;
        }
        .fade-exit {
            opacity: 1;
        }
        .fade-exit-active {
            opacity: 0;
            transition: opacity 300ms ease-out;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="d-flex">
        @include('components.dashboard.sidebar')

        <main class="main-content">
            @if (session('toast'))
                <div x-data="{}" x-init="
                    Toastify({
                        text: '{{ session('toast')['message'] }}',
                        duration: 3000,
                        close: true,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '{{ session('toast')['type'] === 'success' ? '#28a745' : '#dc3545' }}',
                        stopOnFocus: true,
                    }).showToast()
                "></div>
            @endif

            <div class="page-title">
                @yield('title')
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 