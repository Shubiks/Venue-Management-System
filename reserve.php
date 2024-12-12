<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reserve.css">
    <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
    <title>RESERVE VENUE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
<?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
?>
<div class="calendar-container">
    <label for="event-date">Date:</label>
    <input type="text" id="event-date" name="eventdate"  required value="<?php echo date('Y-m-d'); ?>">

    <label for="event-time">Time:</label>
    <input type="text" id="event-time"    name="eventtime" required >
    <input type="hidden" id="hidden-event-time" name="hidden_event_time">
</div>

<div id="venues-container">
    <?php include('fetch_venue.php'); ?>
</div>

<div id="reservation-form" style="display: none;">
    <h1 id="reservation-venue-name"></h1>
    <a href="#" class="close-form-icon">
        <i class="fa-solid fa-xmark"></i>
    </a>
    <form id="reservation-form-data" method="post" action="reserve_form.php" onsubmit="submitForm(event)">
        <input type="hidden" id="hidden-venue-id" name="venue_id" required>
        <label for="team-name">Team Name:</label>
        <input type="text" id="team-name" name="teamName" required>

        <label for="event-name">Event Name:</label>
        <input type="text" id="event-name" name="eventName" required>

        <label for="date">Date:</label>
        <input type="text" id="date" name="date" required>

        <label for="start-time">Start Time:</label>
        <input type="text" id="start-time" name="stime" required>
        <input type="hidden" id="hidden-start-time" name="hidden_stime">

        <label for="end-time">End Time:</label>
        <input type="text" id="end-time" name="etime" required>
        <input type="hidden" id="hidden-end-time" name="hidden_etime">

        <label for="priority">Meeting Priority:</label>
        <select id="priority" name="priority" required>
            <option value="Critical">Critical</option>
            <option value="Urgent">Urgent</option>
            <option value="Important">Important</option>
            <option value="Regular">Regular</option>
        </select>
        <br>
        <div class="form-button-container">
            <input type="submit" class="form_reserve_btn" value="RESERVE" name="reserve">
        </div>
    </form>
</div>

<div id="confirmation-modal" style="display: none;">
    <div id="modal-content">
        <a href="#" class="close"><i class="fa-solid fa-xmark"></i> </a>
        <p>You reserved the venue!</p>
    </div>
</div>
<div id="no-results-message" class="hidden">No venues found for your search.</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="reserve.js"></script> 

</body>
</html>
