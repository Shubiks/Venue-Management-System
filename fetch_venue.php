<?php

session_start(); // Start the session

include 'connect.php';

$eventdate = isset($_GET['eventdate']) ? $_GET['eventdate'] : null;
$eventtime = isset($_GET['eventtime']) ? $_GET['eventtime'] : null;

$sql = "SELECT * FROM reserve_card";
$result = $conn->query($sql);

$bookedVenues = [];
$currentTime = new DateTime($eventtime);

if ($eventdate && $eventtime) {
    $bookedSql = "SELECT ven_id, event_e_time FROM reserve_form WHERE event_date = ? AND event_s_time <= ? AND event_e_time >= ?";
    $stmt = $conn->prepare($bookedSql);
    $stmt->bind_param("sss", $eventdate, $eventtime, $eventtime);
    $stmt->execute();
    $bookedResult = $stmt->get_result();

    while ($row = $bookedResult->fetch_assoc()) {
        $bookedVenues[$row['ven_id']] = new DateTime($row['event_e_time']);
    }

    $stmt->close();
}

if ($result && $result->num_rows > 0) {
    echo '<div class="venues">';
    while ($row = $result->fetch_assoc()) {
        $venueId = $row['ven_id']; // Get the venue_id for each venue
        $status = $row["status"];
        $isBooked = isset($bookedVenues[$venueId]);

        // Determine the appropriate class for the venue card
        $cardClass = 'available';
        $status_text = 'Available';
        $statusClass = 'available';
        $disableReserve = false;

        if ($isBooked) {
            $eventEndTime = $bookedVenues[$venueId];
            $maintenanceEndTime = clone $eventEndTime;
            $maintenanceEndTime->add(new DateInterval('PT30M')); // Add 30 minutes

            if ($currentTime >= $eventEndTime && $currentTime <= $maintenanceEndTime) {
                // Venue is under maintenance
                $cardClass = 'under-maintenance';
                $status_text = 'Under Maintenance';
                $statusClass = 'under-maintenance';
                $disableReserve = true;
            } elseif ($currentTime < $eventEndTime) {
                // Venue is booked
                $cardClass = 'booked';
                $status_text = 'Booked';
                $statusClass = 'booked';
                $disableReserve = true;
            }
        } elseif ($status == "0") {
            // Venue is not available
            $cardClass = 'not-available';
            $status_text = 'Not Available';
            $statusClass = 'not-available';
            $disableReserve = true;
        }

        echo '<div class="venue_card ' . $cardClass . '">';
        echo '<div class="venue_pic">';
        echo '<img src="' . $row["img_path"] . '" alt="' . $row["img_desc"] . '">';
        echo '</div>';
        echo '<div class="venue_details">';
        echo '<h1 class="venue-name">' . $row["venue_name"] . '</h1>';
        echo '<h4>Capacity ' . $row["venue_capacity"] . '</h4>';
        echo '<div class="status">';
        echo '<p class="' . $statusClass . '">&#x25CF; ' . $status_text . '</p>';
        echo '</div>';
        echo '<div class="location">';
        echo '<i class="fa-solid fa-location-dot"></i>';
        echo '<p>Location</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="features_at_venue">';

        // Fetching features for the current venue_id
        $features_query = "SELECT vf.*, f.feature_icon FROM venue_feature vf INNER JOIN feature f ON vf.feature_id = f.feature_id WHERE vf.venue_id = $venueId";
        $features_result = $conn->query($features_query);

        if ($features_result->num_rows > 0) {
            echo '<div class="fea_icons">';
            while ($feature_row = $features_result->fetch_assoc()) {
                $featureIcon = $feature_row['feature_icon'];
                $isAvailable = $feature_row['is_available'];

                // Determine the class based on availability
                $iconClass = ($isAvailable == 1) ? '' : 'disabled';

                // Display the feature icon
                echo '<div class="feature">';
                echo '<i class="' . $featureIcon . ' ' . $iconClass . '"></i>';
                echo '</div>';
            }
            echo '</div>'; // Close fea_icons div
        } else {
            echo '<p>No features available for this venue.</p>';
        }
        echo '</div>'; // Close features_at_venue div

        echo '<div class="button-container">';
        echo '<button class="reserve-btn" data-venue-id="' . $row["ven_id"] . '" data-venue-name="' . $row["venue_name"] . '"' . ($disableReserve ? ' disabled' : '') . '>Reserve</button>';
        echo '</div>';
        echo '</div>'; // Close venue_card div
    }
    echo '</div>'; // Close venues div
} else {
    echo "Error: No venue cards found";
}

$conn->close();
?>
