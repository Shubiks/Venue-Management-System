<?php
// Database credentials
include 'connect.php';
// Write the SQL query to select all data from the reserve_form table
$sql = "SELECT * FROM reserve_form";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Notifications</title>
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <style>
        /* Add your CSS here */

        body {
            padding-top: 60px;
            background: #cac6db;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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

        .notification-status {
            font-weight: bold;
            margin-left: 20px;
        }

        .status-accepted {
            color: green;
        }

        .status-rejected {
            color: red;
        }

    </style>
</head>
<body>
<?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
?>
    <div class="notification-section">
        <h2>Your Notifications</h2>
        <div id="notifications-list">
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='notification'>";
                        echo "<div class='notification-details'>";
                        echo "<p><i class='fa-solid fa-users'></i> " . $row["team_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar'></i>  " . $row["event_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar-day'></i>  " . $row["event_date"] . "</p>"; 
                        echo "<p><i class='fa-solid fa-clock'></i>  " . $row["event_s_time"] . " - " . $row["event_e_time"] . "</p>";
                        echo "</div>";
                        echo "<div class='notification-status'>";
                        $statusClass = '';
                        if ($row["status"] == 'Accepted') {
                            $statusClass = 'status-accepted';
                        } elseif ($row["status"] == 'Rejected') {
                            $statusClass = 'status-rejected';
                        }
                        echo "<p class='$statusClass'>Status: " . (isset($row["status"]) ? $row["status"] : "Unknown") . "</p>";
                        if ($row["status"] == 'Rejected' && isset($row["reject_reason"])) {
                            echo "<p class='status-rejected'>Rejection Reason: " . $row["reject_reason"] . "</p>";
                        }
                        if ($row["status"] == 'Rejected' && isset($row["available_dates"])) {
                            echo "<p>Available Dates: " . $row["available_dates"] . "</p>";
                        }
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
</body>
</html>