document.addEventListener("DOMContentLoaded", function() {
    // Toggle FAQ answer visibility
    function toggleAnswer(id) {
        const allContents = document.querySelectorAll('.faq-content');
        
        // Hide all FAQ answers
        allContents.forEach(content => {
            content.style.display = 'none';
        });

        // Show the selected FAQ answer
        const selectedContent = document.getElementById(id);
        if (selectedContent) {
            selectedContent.style.display = 'block';
        }
    }

    // Expose the toggleAnswer function to the global scope
    window.toggleAnswer = toggleAnswer;

    // Existing JavaScript code for other functionality
    const saveButton = document.querySelector('button[type="button"]');
    saveButton.addEventListener('click', function() {
        const username = document.getElementById('username').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const notifications = document.getElementById('notifications').value;
        const language = document.getElementById('language').value;
        // Save settings...
    });

    // Function to enable dark mode
    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark-theme')) {
            document.documentElement.classList.remove('dark-theme');
            localStorage.removeItem('theme');
        } else {
            document.documentElement.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Set the theme based on local storage
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark-theme');
    }

    // Expose the toggleDarkMode function to the global scope
    window.toggleDarkMode = toggleDarkMode;

    // Logout function
    function logout() {
        // Clear user session data (this may vary depending on your application)
        sessionStorage.clear();
        localStorage.clear();

        // Redirect to login page
        window.location.href = 'index.php';
    }

    // Add event listener for logout link
    const logoutLink = document.getElementById('logout-link');
    if (logoutLink) {
        logoutLink.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior
            logout();
        });
    }
    // Save settings function
    function saveSettings() {
        document.getElementById('settings-form').submit();
    }

    window.saveSettings = saveSettings;
});