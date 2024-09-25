// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function() {
    // Get the button element by its ID
    const button = document.getElementById('myButton');
    
    // Add a click event listener to the button
    button.addEventListener('click', function() {
        // Change the text content of the paragraph with the ID 'message'
        document.getElementById('message').textContent = 'Hello, you clicked the button!';
    });
});



// script.js

document.addEventListener("DOMContentLoaded", function () {
    let currentIndex = 0;
    const images = [
        '5.jpg',
        '8.jpg',
        '11.jpg',
        '37.jpg'
    ];

    const mainDiv = document.getElementById('main');
    const indicators = document.querySelectorAll('.indicator');
    let slideInterval;

    function updateIndicator() {
        indicators.forEach((indicator, index) => {
            if (index === currentIndex) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });
    }

    function changeBackgroundImage(index) {
        mainDiv.style.backgroundImage = `url(${images[index]})`;
        currentIndex = index;
        updateIndicator();
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        changeBackgroundImage(currentIndex);
    }

    function startSlideshow() {
        slideInterval = setInterval(nextSlide, 6000); // Change slide every 3 seconds
    }

    function stopSlideshow() {
        clearInterval(slideInterval);
    }

    // Initialize slideshow
    changeBackgroundImage(currentIndex);
    startSlideshow();

    // Event listeners for indicators
    indicators.forEach((indicator) => {
        indicator.addEventListener('click', function () {
            stopSlideshow(); // Stop slideshow on click
            changeBackgroundImage(parseInt(this.getAttribute('data-index')));
            setTimeout(startSlideshow, 5000); // Resume after 5 seconds
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Get the button element by its ID for the "View our projects" button
    const viewProjectsButton = document.getElementById('viewProjects');
    
    // Add a click event listener to the "View our projects" button
    viewProjectsButton.addEventListener('click', function() {
        // Redirect to the desired page when the button is clicked
        window.location.href = './projects.php'; // Replace with your actual URL
    });

    // Get the button element by its ID for the original button
    const button = document.getElementById('myButton');
    
    // Add a click event listener to the original button
    button.addEventListener('click', function() {
        // Change the text content of the paragraph with the ID 'message'
        document.getElementById('message').textContent = 'Hello, you clicked the button!';
    });
});