/**
 * Real-time Date & Time Updater
 * Updates every second with smooth transitions
 */

$(document).ready(function() {
    function updateDateTime() {
        const now = new Date();
        
        // Format: "Monday, January 15, 2024"
        const dateOptions = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        const formattedDate = now.toLocaleDateString(undefined, dateOptions);
        
        // Format: "14:30:45" or "02:30:45 PM" (based on user locale)
        const timeOptions = { 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit',
            hour12: true 
        };
        const formattedTime = now.toLocaleTimeString(undefined, timeOptions);
        
        // Update DOM
        $('#currentDate').text(formattedDate);
        $('#currentTime').text(formattedTime);
    }
    
    // Initial update
    updateDateTime();
    
    // Update every second (1000ms)
    setInterval(updateDateTime, 1000);
    
    // Optional: Add animation effect when time changes
    let lastSecond = new Date().getSeconds();
    setInterval(function() {
        const currentSecond = new Date().getSeconds();
        if (currentSecond !== lastSecond) {
            $('#currentTime').addClass('time-tick');
            setTimeout(() => {
                $('#currentTime').removeClass('time-tick');
            }, 200);
            lastSecond = currentSecond;
        }
    }, 100);
});