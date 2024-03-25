document.addEventListener("DOMContentLoaded", function() {
    const pickupDateInput = document.getElementById('pickup_date');
    const dropoffDateInput = document.getElementById('dropoff_date');
    
    // Get today's date
    const today = new Date();
    const todayFormatted = today.toISOString().slice(0, 16);
    
    pickupDateInput.min = todayFormatted; // Set the min attribute to today
    
    pickupDateInput.addEventListener('change', () => {
        const pickupDate = new Date(pickupDateInput.value);
        const minDropoffDate = new Date(pickupDate);
        minDropoffDate.setDate(pickupDate.getDate() +
            1); // Set minimum dropoff date to be at least 1 day after pickup
    
        dropoffDateInput.disabled = false;
        dropoffDateInput.min = minDropoffDate.toISOString().slice(0, 16); // Set the min attribute
    });
});