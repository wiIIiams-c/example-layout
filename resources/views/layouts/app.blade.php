<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Lobibox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/lobibox.min.css') }}">
    
    <!-- Alpine.js - Commenting out since Livewire 3 already includes it -->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script> -->
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
    
    <!-- Scripts -->
    @livewireStyles
</head>
<body>
    <!-- Include the notification component at the app layout level -->
    <x-notification />
    
    <div class="min-vh-100 d-flex flex-column">
        <!-- Header -->
        @include('layouts.partials.header')

        <!-- Output notification script if it exists -->
        @if(session()->has('notification_script'))
            {!! session('notification_script') !!}
        @endif

        <div class="container-fluid flex-grow-1">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 bg-light sidebar">
                    @include('layouts.partials.sidebar')
                </div>

                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Footer -->
        @include('layouts.partials.footer')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for Lobibox) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Lobibox JS -->
    <script src="{{ asset('assets/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/js/notification-custom-script.js') }}"></script>
    
    <!-- Session storage notification system -->
    <script>
        // Function to show notifications from session storage
        function checkSessionStorageForNotifications() {
            var notification = sessionStorage.getItem('notification');
            if (notification) {
                try {
                    var data = JSON.parse(notification);
                    if (typeof Lobibox !== 'undefined') {
                        Lobibox.notify(data.type, {
                            title: data.title,
                            msg: data.message,
                            position: 'top right',
                            sound: false,
                            delay: 4000
                        });
                    }
                    // Clear the notification so it doesn't show again
                    sessionStorage.removeItem('notification');
                } catch (e) {
                    console.error('Error parsing notification:', e);
                }
            }
        }
        
        // Set a notification to show when redirected
        window.setRedirectNotification = function(type, message, title) {
            sessionStorage.setItem('notification', JSON.stringify({
                type: type,
                message: message,
                title: title || type.charAt(0).toUpperCase() + type.slice(1)
            }));
        };
        
        // Check for notifications on page load
        document.addEventListener('DOMContentLoaded', function() {
            checkSessionStorageForNotifications();
        });
    </script>
    
    @livewireScripts
    @stack('scripts')
</body>
</html> 