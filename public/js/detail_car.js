
// Get pe option images and pe display image element
const optionImages = document.querySelectorAll('.option');
const displayImage = document.querySelector('.display_image');

// Add click event listeners to each option image
optionImages.forEach(optionImage => {
    optionImage.addEventListener('click', function () {
        // Set pe clicked option image as pe background of pe display image
        const imageUrl = optionImage.getAttribute('src');
        displayImage.style.backgroundImage = `url(${imageUrl})`;
    });
});
