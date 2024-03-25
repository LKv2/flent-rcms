
    function isAvailableForPeriod(startDate, finishDate, bookings) {
        if (bookings) {
            for (let i = 0; i < bookings.length; i++) {
                const bookingStartDate = new Date(bookings[i].pickup_date);
                const bookingFinishDate = new Date(bookings[i].dropoff_date);

                if (
                    (startDate >= bookingStartDate && startDate <= bookingFinishDate) ||
                    (finishDate >= bookingStartDate && finishDate <= bookingFinishDate) ||
                    (startDate <= bookingStartDate && finishDate >= bookingFinishDate)
                ) {
                    return false; // Car is not available for this period
                }
            }
        }

        return true; // Car is available for the requested period
    }

    const pickupDateInput = document.getElementById('pickup_date');
    const dropoffDateInput = document.getElementById('dropoff_date'); // Initialize the cars variable as an empty array
    const availible_cars = document.getElementById('availible_cars'); // Initialize the cars variable as an empty array
function updateCarList() {
        const pickupDate = new Date(pickupDateInput.value);
        const dropoffDate = new Date(dropoffDateInput.value);
        const availableCars = [];
        // Check if both pickup and dropoff dates have values
        if (pickupDateInput.value && dropoffDateInput.value) {
            availible_cars.innerHTML = '@foreach ($cars as $car)<x-card-cars :car="$car" />@endforeach';
            for (let i = 0; i < cars.length; i++) {
                const bookingsCar = bookings.filter((book) => {
                    return book.car_id == cars[i].id && book.reservation_status == 'confirmée'
                });
                if (isAvailableForPeriod(pickupDate, dropoffDate, bookingsCar)) {
                    availableCars.push(cars[i].id);
                } else {
                    const elementToRemove = document.getElementById(`${cars[i].nrchassis}`);
                    if (elementToRemove) {
                        elementToRemove.remove();
                    }
                }
            }
        }
    }
    

    document.addEventListener("DOMContentLoaded", function() {
        const sidebarButton = document.querySelector('[data-drawer-toggle="filterform"]');
        pickupDateInput.addEventListener('change', () => {
            updateCarList();
        });
        dropoffDateInput.addEventListener('change', () => {
            updateCarList();
        });
    });