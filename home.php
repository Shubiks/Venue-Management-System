<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <link href="home.css" rel="stylesheet">
</head>
<body>
<?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
?>
    <main>
        <div class="middle">
            <h1>Venue Management System</h1>
        </div>
        <section class="hero">
            <h2>Welcome to Your One-Stop Venue Solution</h2><br>
            <p>Manage your venues, bookings, and events with ease.</p>
            <div>
                <button type="button" id ="bt">
                    <a href="see_more.html">See More</a>
                </button>
            </div>
        </section>
    </main>
    <footer>
        <div class="flogo">
            <p>&copy; 2024 Venue Management System</p><br>
            <a href="https://maps.google.com/?q=Your+Company+Location" target="_blank" title="Location">
                <i class="fa-solid fa-location-dot center"></i>
            </a>
            <a href="mailto:support@itcompany.com" title="Email">
                <i class="fa-solid fa-envelope center"></i>
            </a>
            <a href="tel:+1234567890" title="Call">
                <i class="fa-solid fa-phone center"></i>
            </a>
            <a href="#" onclick="alert('Available timings: Mon-Fri 9 AM - 5 PM');" title="Working Hours">
                <i class="fa-solid fa-clock center"></i>
            </a>
        </div>
    </footer>
</body>
</html>