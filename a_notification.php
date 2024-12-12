<?php
// Database credentials
$servername = "srv544.hstgr.io";
$username = "u745359346_WDIAPR24T3";
$password = "WDIAPR24Team3.Calanjiyam@2024";
$dbname = "u745359346_WDIAPR24T3";
$port = 3306;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update status based on the action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $teamName = $_POST['team_name'];
    $eventName = $_POST['event_name'];
    $action = $_POST['action'];
    
    $status = '';
    $rejectReason = '';
    $availableDates = '';
    if ($action === 'accept') {
        $status = 'Accepted';
    } elseif ($action === 'reject') {
        $status = 'Rejected';
        if (isset($_POST['reject_reason'])) {
            $rejectReason = $_POST['reject_reason'];
        }
        if (isset($_POST['available_dates'])) {
            $availableDates = $_POST['available_dates'];
        }
    }

    $update_sql = "UPDATE reserve_form SET status='$status', reject_reason='$rejectReason', available_dates='$availableDates' WHERE team_name='$teamName' AND event_name='$eventName'";
    if ($conn->query($update_sql) === TRUE) {
        echo "<div class='alert-box success'>Invitation status updated successfully<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span></div>";
    } else {
        echo "<div class='alert-box error'>Error updating status: " . $conn->error . "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span></div>";
    }
}

// Write the SQL query to select all data from the reserve_form table
$sql = "SELECT * FROM reserve_form";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Notifications</title>
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* CSS styling */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #cac6db;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #7163BA;
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            color: #ffffff;
        }

        .navigation a {
            text-decoration: none;
            color: #ffffff;
            padding: 6px 15px;
            border-radius: 20px;
            margin: 0 10px;
            font-weight: 600;
        }

        .navigation a:hover,
        .navigation a.active {
            background: #ffffff;
            color: #7163BA;
        }

        .notification-section {
            width: 80%;
            margin: 50px auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 20px 20px rgba(161, 127, 240, 0.288);
        }

        .notification {
            background-color: #ffffff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        }

        .notification-details {
            flex: 1;
        }

        .notification-details p {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .notification-details p i {
            margin-right: 10px;
        }

        .notification-actions {
            display: flex;
            gap: 10px;
        }

        .notification-actions form {
            display: flex;
            gap: 10px;
        }

        .notification-actions button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .notification-actions .accept-btn {
            background-color: green;
        }

        .notification-actions .reject-btn {
            background-color: red;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .alert-box {
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
            position: fixed;
            top: 20px;
            right: 20px;
            width: calc(100% - 40px);
            max-width: 300px;
            z-index: 1000;
        }

        .alert-box.success {
            background-color: #4CAF50;
            color: white;
        }

        .alert-box.error {
            background-color: #f44336;
            color: white;
        }

        .alert-box .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .alert-box .closebtn:hover {
            color: black;
        }

        .reject-form label {
            display: block;
            margin: 10px 0 5px;
        }

        .reject-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .reject-form button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .reject-form button:hover {
            background-color: darkred;
        }

        .modal-content h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="head">
        <!-- Header content -->
        <a class="logo" href="logo.html">Logo</a>
        <nav class="navigation">
            <a href="a_ven.php">Venue</a>
            <a href="a_upcoming_events.php">Upcoming Event</a>
            <a class="active" href="a_notification.php">Notification</a>
            <a href="a_settings.html">Settings</a>
            <a href="index.php">Logout</a>
        </nav>
    </header>
    <div class="notification-section">
        <h2>Admin Notifications</h2>
        <div id="notifications-list">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='notification'>";
                        echo "<div class='notification-details'>";
                        echo "<p><i class='fa-solid fa-users'></i> " . $row["team_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar'></i> " . $row["event_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar-day'></i> " . $row["event_date"] . "</p>";
                        echo "<p><i class='fa-solid fa-clock'></i> " . $row["event_s_time"] . " - " . $row["event_e_time"] . "</p>";
                        echo "</div>";
                        echo "<div class='notification-actions'>";
                        echo "<form method='POST'>";
                        echo "<input type='hidden' name='team_name' value='" . $row["team_name"] . "'>";
                        echo "<input type='hidden' name='event_name' value='" . $row["event_name"] . "'>";
                        echo "<button type='submit' name='action' value='accept' class='accept-btn'>Accept</button>";
                        echo "<button type='button' class='reject-btn' onclick='openRejectModal(\"" . $row["team_name"] . "\", \"" . $row["event_name"] . "\")'>Reject</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No notifications found";
                }
                $conn->close();
            ?>
        </div>
    </div>

    <!-- The Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="rejectForm" method="POST" class="reject-form">
                <h2>Rejection Details</h2>
                <label for="reject_reason">Reason for Rejection:</label>
                <input type="text" id="reject_reason" name="reject_reason" required>
                <br>
                <label for="available_dates">Available Dates:</label>
                <input type="text" id="available_dates" name="available_dates" required>
                <input type="hidden" id="team_name" name="team_name">
                <input type="hidden" id="event_name" name="event_name">
                <br><br>
                <button type="submit" name="action" value="reject" class="reject-btn">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Get the modal
        var modal = document.getElementById("rejectModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Function to open the reject modal
        function openRejectModal(teamName, eventName) {
            document.getElementById('team_name').value = teamName;
            document.getElementById('event_name').value = eventName;
            modal.style.display = "block";
        }

        // Initialize flatpickr for multiple date selection
        flatpickr("#available_dates", {
            mode: "multiple",
            dateFormat: "Y-m-d"
        });
    </script>
</body>
</html>