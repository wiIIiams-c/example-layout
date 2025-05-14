@props(['message' => null, 'type' => 'success', 'title' => null])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Lobibox is defined
        if (typeof Lobibox === 'undefined') {
            return;
        }
        
        // Direct check for session data without using Blade if statements
        setTimeout(function() {
            // This will run after a brief delay to ensure everything is loaded
            let sessionMessage = "{{ session('message') }}";
            let sessionError = "{{ session('error') }}";
            let sessionInfo = "{{ session('info') }}";
            let sessionWarning = "{{ session('warning') }}";
            
            if (sessionMessage && sessionMessage !== "") {
                Lobibox.notify('success', {
                    title: 'Success',
                    msg: sessionMessage,
                    position: 'top right',
                    sound: false,
                    delay: 4000
                });
            }
            
            if (sessionError && sessionError !== "") {
                Lobibox.notify('error', {
                    title: 'Error',
                    msg: sessionError,
                    position: 'top right',
                    sound: false,
                    delay: 4000
                });
            }
            
            if (sessionInfo && sessionInfo !== "") {
                Lobibox.notify('info', {
                    title: 'Information',
                    msg: sessionInfo,
                    position: 'top right',
                    sound: false,
                    delay: 4000
                });
            }
            
            if (sessionWarning && sessionWarning !== "") {
                Lobibox.notify('warning', {
                    title: 'Warning',
                    msg: sessionWarning,
                    position: 'top right',
                    sound: false,
                    delay: 4000
                });
            }
        }, 300);
        
        // If there's a message passed directly to the component, show it immediately
        @if($message)
            Lobibox.notify('{{ $type }}', {
                title: '{{ $title ?? 'Notification' }}',
                msg: '{{ $message }}',
                position: 'top right',
                sound: false,
                delay: 4000
            });
        @endif
    });

    // Make the notification dispatcher available globally
    window.showNotification = function(type, message, title = null) {
        if (typeof Lobibox === 'undefined') {
            return;
        }
        
        Lobibox.notify(type, {
            title: title || (type.charAt(0).toUpperCase() + type.slice(1)),
            msg: message,
            position: 'top right',
            sound: false,
            delay: 4000
        });
    }
</script> 