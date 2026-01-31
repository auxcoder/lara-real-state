import * as BS from "bootstrap";
window.bootstrap = BS;

import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Title to slug converter
document.addEventListener("DOMContentLoaded", function() {
    const titleInput = document.getElementById("title_en");
    const slugInput = document.getElementById("slug");

    if (titleInput && slugInput) {
        titleInput.addEventListener("input", function() {
            let title = titleInput.value;
            let slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
            slugInput.value = slug;
        });
    }

    // Sidebar toggle
    const toggleButtons = document.querySelectorAll('.button-toggle-menu');
    const sidebar = document.getElementById('sidebarWrapper');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    });
});
