import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Debounced search for transactions need to understand//
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.querySelector('input[name="search"]');

        if (!searchInput) return;

        const handleSearch = debounce(() => {
            searchInput.form.submit();
        }, 400);

        searchInput.addEventListener('input', handleSearch);
    });

    function debounce(callback, delay = 300) {
        let timeout;

        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => callback.apply(this, args), delay);
        };
    }
// Auto-hide welcome alert after 3 seconds//
setTimeout(() => {
        const alert = document.getElementById('welcome-alert');
        if (alert) {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000);