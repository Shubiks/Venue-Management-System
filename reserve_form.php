<?php

include 'connect.php';

$teamName = $_POST['teamName'];
$eventName = $_POST['eventName'];
$date = $_POST['date'];
$stime = $_POST['hidden_stime'];
$etime = $_POST['hidden_etime'];
$priority = $_POST['priority'];
$venue_id = $_POST['venue_id']; // Corrected this line

$insertsql = "INSERT INTO reserve_form (reserve_id, team_name, event_name, event_date, event_s_time, event_e_time, priority_flag, ven_id) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insertsql);
$stmt->bind_param("sssssss", $teamName, $eventName, $date, $stime, $etime, $priority, $venue_id); // Corrected this line

if ($stmt->execute()) {
    echo "Reservation successfully added!";
} else {
    echo "Error: " . $insertsql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>


