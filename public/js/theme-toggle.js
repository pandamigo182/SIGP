/**
 * Dark Mode Toggle Script
 * Handles theme switching and persistence via localStorage
 */

const ThemeManager = {
    init: function () {
        this.storedTheme = localStorage.getItem('theme');
        this.systemPreference = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

        // Determine initial theme
        this.currentTheme = this.storedTheme || this.systemPreference;

        // Apply theme without animation initially to prevent flash
        this.applyTheme(this.currentTheme);

        // Listen for system changes if no override is set
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!localStorage.getItem('theme')) {
                this.applyTheme(e.matches ? 'dark' : 'light');
            }
        });
    },

    applyTheme: function (theme) {
        document.documentElement.setAttribute('data-theme', theme);
        this.currentTheme = theme;
        this.updateIcon(theme);
    },

    toggle: function () {
        const newTheme = this.currentTheme === 'dark' ? 'light' : 'dark';
        this.applyTheme(newTheme);
        localStorage.setItem('theme', newTheme);
    },

    updateIcon: function (theme) {
        const btn = document.getElementById('themeToggleBtn');
        if (btn) {
            const icon = btn.querySelector('i');
            if (theme === 'dark') {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        }
    }
};

// Initialize immediately to prevent FOUC (Flash of Unstyled Content)
ThemeManager.init();

// Expose globally
window.toggleTheme = () => ThemeManager.toggle();
