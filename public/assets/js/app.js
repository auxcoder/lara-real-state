/**
 * Custom Application Scripts
 *
 * Entry point for custom JavaScript functionality.
 * Bootstrap, Alpine.js, and HTMX are loaded via Vite.
 *
 * Add your custom scripts below:
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Initialize Bootstrap popovers
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

    // Add your custom initialization code here
    console.log('Custom scripts loaded');
});
