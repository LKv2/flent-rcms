const rentbox = document.getElementById('rentbox');
const paragraph = rentbox.querySelector('p');
const formbook = rentbox.querySelector('form');// Get the paragraph element
let isExpanded = false;

rentbox.addEventListener('click', () => {
        // Set the expanded width (e.g., 100%) for both desktop and mobile
        rentbox.style.width = '90%';
        if (window.innerWidth >= 768) {
            // Set the original width for desktop (e.g., 25%)
            rentbox.style.height = '100px';
        } else {
            // Set the original width for mobile (e.g., 50%)
           rentbox.style.height = '550px';
            
        }
         // Set the expanded height
        paragraph.style.display = 'none';
        rentbox.classList.remove("animate-bounce");
        formbook.style.display = 'flex';// Hide the paragraph
    
});