<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <title>Venue Management System</title>
    <link href="navbar.css" rel="stylesheet">
</head>
<body>
    <header class="head">
        <a class="logo" href ="home.php">Logo</a>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for Venues">
            <button id="searchBtn" onclick="handleSearch()">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <nav class="navigation">
            
            <?php
            $pages = [
                'user.php' => 'User',
                'reserve.php' => 'Reserve',
                'invitation.php' => 'Invitation',
                'notification.php' => 'Notification',
                'settings.php' => 'Settings',
                'Logout.php' => 'Logout'
            ];

            foreach ($pages as $url => $label) {
                $activeClass = ($url == $currentPage) ? 'active' : '';
                echo "<a href=\"$url\" class=\"$activeClass\">$label</a>";
            }
            ?>
        </nav>
    </header>
</body>
</html>
