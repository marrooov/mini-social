import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

// Simple greeting function
function showGreeting() {
    alert('Welcome to MiniSocial! Enjoy the next-gen social experience.');
}

// Execute the function on page load
document.addEventListener('DOMContentLoaded', function() {
    showGreeting();
});
