const searchInput = document.getElementById('searchInput');
const clt = document.getElementById('client_id');
const clt2 = document.getElementById('client2_id');
const dropdownContent = document.getElementById('dropdownContent');
const selectedClientsList = document.getElementById('selectedClientsList');
const options = dropdownContent.querySelectorAll('li');
const maxClients = 2; // Set the maximum number of clients

function toggleDropdown() {
    dropdownContent.style.display = 'block';
}

searchInput.addEventListener('input', function () {
    const searchText = searchInput.value.toLowerCase();
    options.forEach(option => {
        const text = option.textContent.toLowerCase();
        if (text.includes(searchText)) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
});

// Handle option selection and adding to the list
options.forEach(option => {
    option.addEventListener('click', function () {
        const clientId = option.id;
        const clientName = option.textContent;

        // Check if the maximum number of clients is reached
        if (selectedClientsList.childElementCount < maxClients) {
            // Check if the client is not already selected
            if (!selectedClientsList.querySelector(`[data-client="${clientId}"]`)) {
                const listItem = document.createElement('li');
                listItem.textContent = clientName;
                listItem.setAttribute('data-client', clientId);

                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.classList.add('ml-12', 'bg-red-500', 'text-black', 'p-1', 'rounded', 'cursor-pointer');
                removeButton.addEventListener('click', () => removeClient(clientId));

                listItem.appendChild(removeButton);
                selectedClientsList.appendChild(listItem);

                // Update the hidden input fields for the selected client
                setClientInput(clientId);
            }

            // Close the dropdown
            dropdownContent.style.display = 'none';
        }
    });
});

// Function to update the hidden input fields for the selected client
function setClientInput(clientId) {
    for (let i = 0; i <= maxClients; i++) {
        const hiddenInput = document.getElementById(`client${i + 1}_id`);
        if (hiddenInput && hiddenInput.value === '') {
            hiddenInput.value = clientId;
            break;
        }
    }
}

// Function to remove a selected client from the list
function removeClient(clientId) {
    const listItem = selectedClientsList.querySelector(`[data-client="${clientId}"]`);
    if (listItem) {
        listItem.remove();

        // Clear the corresponding hidden input field
        const hiddenInput = document.getElementById(`client${selectedClientsList.childElementCount + 1}_id`);
        if (hiddenInput) {
            hiddenInput.value = '';
        }
    }
}

// Close the dropdown when clicking outside
document.addEventListener('click', function (e) {
    if (!dropdownContent.contains(e.target) && e.target !== searchInput) {
        dropdownContent.style.display = 'none';
    }
});