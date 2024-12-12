<!DOCTYPE html>
<html>
<head>
    <title>Settings Page</title>
    <link href="settings.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
?>
    
    <div class="settings-section">
        <h2>Settings</h2>
        <form id="settings-form" action="settings.php" method="post">
            <div class="form-group">
                <label for="username"><i class="fa-solid fa-user"></i> Username</label>
                <input type="text" id="username" name="UserName" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                <input type="email" id="email" name="Email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
                <input type="password" id="password" name="Password" placeholder="Enter your password">
            </div>
            <div class="form-group">
                <label for="notifications"><i class="fa-solid fa-bell"></i> Notifications</label>
                <select id="notifications" name="Notifications">
                    <option value="all">All</option>
                    <option value="email">Email Only</option>
                    <option value="none">None</option>
                </select>
            </div>
            <div class="form-group dark-theme" id="dark-mode-toggle" onclick="toggleDarkMode()">
                <label for="theme"><i class="fa-solid fa-moon"></i> Dark Theme</label>
            </div>                       
            <div class="form-group">
                <label for="language"><i class="fa-solid fa-language"></i> Language</label>
                <select id="language" name="Language">
                    <option value="english">English</option>
                    <option value="spanish">Spanish</option>
                    <option value="french">French</option>
                </select>
            </div>
            <button type="button" onclick="saveSettings()">Save Settings</button>
        </form>
        
        <div class="help-faq">
            <h3>Help & FAQ</h3>
            <ul>
                <li><a href="#how-to-use" onclick="toggleAnswer('how-to-use')">How to use the platform?</a></li>
                <li><a href="#reset-password" onclick="toggleAnswer('reset-password')">How to reset password?</a></li>
                <li><a href="#contact-support" onclick="toggleAnswer('contact-support')">Contact support</a></li>
            </ul>
            <div id="how-to-use" class="faq-content">
                <h4>How to use the platform?</h4>
                <p>To use this platform for book management, you can follow these steps:</p>
                <ol>
                    <li>Log in to your account.</li>
                    <li>Navigate to the "Book Management" section from the main menu.</li>
                    <li>Here, you can add, edit, and delete book entries.</li>
                    <li>Use the search bar to quickly find specific books by title or author.</li>
                </ol>
            </div>
            <div id="reset-password" class="faq-content">
                <h4>How to reset password?</h4>
                <p>If you need to reset your password, follow these steps:</p>
                <ol>
                    <li>Go to the Settings page.</li>
                    <li>In the "Password" section, enter your current password and then your new password.</li>
                    <li>Click "Save Settings" to apply the changes.</li>
                </ol>
            </div>
            <div id="contact-support" class="faq-content">
                <h4>Contact support</h4>
                <p>If you need to contact support, you can reach us at:</p>
                <ul>
                    <li>Email: support@example.com</li>
                    <li>Phone: (123) 456-7890</li>
                    <li>Address: 123 Main Street, City, Country</li>
                </ul>
            </div>
        </div>
    </div>

    <script src="settings.js"></script>
</body>
</html>