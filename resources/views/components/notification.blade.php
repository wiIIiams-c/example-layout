<!-- Notification component leveraging session flash messages -->
<script>
    // Flag to track if notifications have been shown - use window to avoid duplicate declarations
    window.notificationsShown = window.notificationsShown || false;
    
    // Execute once the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Notification component loaded');
        
        // Check for Lobibox availability
        if (typeof Lobibox === 'undefined') {
            console.error('Lobibox notification library not loaded!');
            return;
        }
        
        // Only process session messages if no event-based notifications were shown
        if (!window.notificationsShown) {
            // Process error messages (if any)
            var errorMessage = "{{ session('error') }}";
            if (errorMessage && errorMessage.trim() !== '') {
                console.log('Displaying session error message:', errorMessage);
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-error',
                    msg: errorMessage,
                    delay: 4000,
                    sound: false
                });
            }
            
            // Process success messages (if any)
            var successMessage = "{{ session('success') }}";
            if (successMessage && successMessage.trim() !== '') {
                console.log('Displaying session success message:', successMessage);
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    icon: 'bx bx-check-circle',
                    msg: successMessage,
                    delay: 4000,
                    sound: false
                });
            }
        }
    });

    // Add Livewire event listeners once Livewire is initialized
    document.addEventListener('livewire:initialized', function() {
        console.log('Livewire initialized in notification component');
        
        // Listen for showNotification event
        Livewire.on('showNotification', params => {
            console.log('Show notification event received:', params);
            
            if (typeof Lobibox === 'undefined') {
                console.error('Lobibox notification library not loaded!');
                return;
            }
            
            // Mark that we've shown a notification via event
            window.notificationsShown = true;
            
            Lobibox.notify(params[0].type || 'info', {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: params[0].type === 'error' ? 'bx bx-error' : 
                     params[0].type === 'success' ? 'bx bx-check-circle' : 'bx bx-info-circle',
                msg: params[0].message,
                title: params[0].title,
                delay: 4000,
                sound: false
            });
        });
    });
</script>