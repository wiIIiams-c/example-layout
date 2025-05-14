@props(['message' => null, 'type' => 'success', 'title' => null])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if Lobibox is defined
        if (typeof Lobibox === 'undefined') {
            console.error('Lobibox notification library not loaded!');
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
                    delay: 4000,
                    width: 400
                });
            }
            
            if (sessionError && sessionError !== "") {
                Lobibox.notify('error', {
                    title: 'Error',
                    msg: sessionError,
                    position: 'top right',
                    sound: false,
                    delay: 4000,
                    width: 400,
                    messageHeight: 60
                });
            }
            
            if (sessionInfo && sessionInfo !== "") {
                Lobibox.notify('info', {
                    title: 'Information',
                    msg: sessionInfo,
                    position: 'top right',
                    sound: false,
                    delay: 4000,
                    width: 400
                });
            }
            
            if (sessionWarning && sessionWarning !== "") {
                Lobibox.notify('warning', {
                    title: 'Warning',
                    msg: sessionWarning,
                    position: 'top right',
                    sound: false,
                    delay: 4000,
                    width: 400
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
                delay: 4000,
                width: 400,
                messageHeight: '{{ $type }}' === 'error' ? 60 : undefined
            });
        @endif
    });

    // Make the notification dispatcher available globally
    window.showNotification = function(type, message, title = null) {
        if (typeof Lobibox === 'undefined') {
            console.error('Lobibox notification library not loaded!');
            return;
        }
        
        console.log('Showing notification:', {type, message, title});
        
        Lobibox.notify(type, {
            title: title || (type.charAt(0).toUpperCase() + type.slice(1)),
            msg: message,
            position: 'top right',
            sound: false,
            delay: 4000,
            width: 400,
            messageHeight: type === 'error' ? 60 : undefined
        });
    }
</script> 