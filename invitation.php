<?php
// Database credentials
include 'connect.php';

// Write the SQL query to select all data from the reserve_form table
$sql = "SELECT * FROM reserve_form";
$result = $conn->query($sql);

// Check if the cancel form is submitted
if(isset($_POST['cancel'])) {
    // Get team name and event name from the form submission
    $teamName = $_POST['team_name'];
    $eventName = $_POST['event_name'];
    
    // Prepare and execute the SQL query to delete the reservation
    $delete_sql = "DELETE FROM reserve_form WHERE team_name='$teamName' AND event_name='$eventName'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Reservation canceled successfully');</script>";
    } else {
        echo "<script>alert('Error canceling reservation: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invitation Page</title>
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <style>
    

        body {
            padding-top: 60px;
            background: #cac6db;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .invitation-section {
            width: 80%;
            margin: 50px auto;
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 20px 20px rgba(161, 127, 240, 0.288);
        }

        .invitation {
            background-color: #ffffff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.1);
        }

        .invitation-details p {
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .invitation-details p i {
            margin-right: 10px;
        }

        .invitation-actions {
            display: flex;
            gap: 5px;
        }

        .invitation-actions button {
            border: none;
            color: white;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .invitation-actions button.view {
            background-color: #4CAF50;
        }

        .invitation-actions button.cancel {
            background-color: #f44336;
        }

        .invitation-actions button:hover {
            opacity: 0.8;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
<?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
?>
    <div class="invitation-section">
        <h2>Your Invitations</h2>
        <div id="invitations-list">
            <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='invitation'>";
                        echo "<div class='invitation-details'>";
                        echo "<p><i class='fa-solid fa-users'></i> " . $row["team_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar'></i>  " . $row["event_name"] . "</p>";
                        echo "<p><i class='fa-solid fa-calendar-day'></i>  " . $row["event_date"] . "</p>"; 
                        echo "<p><i class='fa-solid fa-clock'></i>  " . $row["event_s_time"] . " - " . $row["event_e_time"] . "</p>";
                        echo "</div>";
                        echo "<div class='invitation-actions'>";
                        echo "<button class='view' data-team='" . $row["team_name"] . "' data-event='" . $row["event_name"] . "'>View</button>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='team_name' value='" . $row["team_name"] . "'/>";
                        echo "<input type='hidden' name='event_name' value='" . $row["event_name"] . "'/>";
                        echo "<button type='submit' name='cancel' class='cancel'>Cancel</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No results found";
                }
                $conn->close();
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.view').forEach(function (button) {
                button.addEventListener('click', function () {
                    const teamName = this.getAttribute('data-team');
                    const eventName = this.getAttribute('data-event');
                    alert('Team Name: ' + teamName + '\nEvent Name: ' + eventName);
                    // Add code to handle the view action, e.g., redirect to a detailed view page
                });
            });

            document.querySelectorAll('.cancel').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    const teamName = form.querySelector('input[name="team_name"]').value;
                    const eventName = form.querySelector('input[name="event_name"]').value;
                    if (confirm('Are you sure you want to cancel this reservation?\nTeam Name: ' + teamName + '\nEvent Name: ' + eventName)) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>