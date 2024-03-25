// Function to fetch real-time positions from Traccar API
function fetchRealTimePositions() {
    fetch('/traccar/devices')
        .then(response => response.json())
        .then(devices => {
            devices.forEach(device => {
                fetch(`/traccar/device/${device.id}/positions`)
                    .then(response => response.json())
                    .then(positions => {
                        // Process positions for the device
                        console.log(positions);
                    })
                    .catch(error => console.error('Error fetching positions:', error));
            });
        })
        .catch(error => console.error('Error fetching devices:', error));
}


