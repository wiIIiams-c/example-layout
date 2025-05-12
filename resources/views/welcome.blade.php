<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background: #f8fafc;
            }
            .hero {
                min-height: 100vh;
                display: flex;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <div class="hero">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h1 class="display-4 mb-4">Welcome to Laravel & Livewire Layout Demo</h1>
                        <p class="lead mb-5">
                            This demonstration shows how to implement a layout with Laravel 10 and Livewire 3, 
                            where only the content section updates when navigating between pages.
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-4 gap-3">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard
                            </a>
                            <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-lg px-4">
                                <i class="bi bi-box me-2"></i> Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
