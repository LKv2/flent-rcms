function handleDateInputs(delivranceId, validiteId, validityYears) {
    // Get references to the date inputs
    const dateDelivranceInput = document.getElementById(delivranceId);
    const dateValiditeInput = document.getElementById(validiteId);

    // Add an event listener to the dateDelivranceInput
    dateDelivranceInput.addEventListener('input', function() {
        // Get the selected date from dateDelivranceInput
        const selectedDate = new Date(this.value);

        if (!isNaN(selectedDate.getTime())) {
            // If it's a valid date, enable dateValiditeInput
            dateValiditeInput.disabled = false;

            // Calculate the date based on the validityYears
            const validiteDate = new Date(selectedDate);
            validiteDate.setFullYear(validiteDate.getFullYear() + validityYears);

            // Format the validiteDate as yyyy-mm-dd (the format for date inputs)
            const yyyy = validiteDate.getFullYear();
            const mm = String(validiteDate.getMonth() + 1).padStart(2, '0');
            const dd = String(validiteDate.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;

            // Set the value of dateValiditeInput to the calculated date
            dateValiditeInput.value = formattedDate;
        } else {
            // If the date is not valid, disable and clear dateValiditeInput
            dateValiditeInput.disabled = true;
            dateValiditeInput.value = '';
        }
    });
}
function getCurrentDateTime() {
    const now = new Date();
    return now.toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:mm
}
    function checkPassportInput() {
        
        const passportFileInput = document.getElementById("file_input_Pass");
        const PassValide_date = document.getElementById("PassValide_date");
        const PassDelivre_date = document.getElementById("PassDelivre_date");

        if (passportInput.value !== '') {
            passportFileInput.removeAttribute("disabled");
            PassValide_date.removeAttribute("disabled");
            PassDelivre_date.removeAttribute("disabled");
        } else {
            passportFileInput.setAttribute("disabled", "disabled");
            PassValide_date.setAttribute("disabled", "disabled");
            PassDelivre_date.setAttribute("disabled", "disabled");
        }
    }
