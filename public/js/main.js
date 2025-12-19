// Custom JS Implementation

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-hide loader on page load (failsafe)
    hideLoader();

    // Show loader on form submit
    const forms = document.querySelectorAll('form:not(.no-loader)');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            // Only show if form is valid (if using browser validation)
            if(this.checkValidity()){
                showLoader();
            }
        });
    });

    // Show loader on links that are not internal anchors or JS actions
    const links = document.querySelectorAll('a[href]:not([href^="#"]):not([href^="javascript:"]):not([target="_blank"])');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            // Check if Ctrl/Cmd click (new tab)
            if (e.ctrlKey || e.metaKey) return;
            showLoader();
        });
    });

    // Initialize Tooltips (Bootstrap 5)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});

// Loader Functions
function showLoader() {
    const loader = document.getElementById('loader-overlay');
    if(loader) loader.style.display = 'flex';
}

function hideLoader() {
    const loader = document.getElementById('loader-overlay');
    if(loader) loader.style.display = 'none';
}

// Global expose
window.showLoader = showLoader;
window.hideLoader = hideLoader;
