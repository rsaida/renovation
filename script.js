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
