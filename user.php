<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="user.css">
</head>
<body>
    <?php
    $currentPage = basename($_SERVER['PHP_SELF']); 
    include 'navbar.php'; 
    ?>
    <table align="left" cellpadding="79" cellspacing="80">
        <tr align="center">
        <td><b><u>10:00-11:00 </u></b>ConferenceHall-1 BoardMeeting</td>
        <td><b><u>11:00-12:00 </u></b> StandUpMeetings</td>
        <td><b><u>12:00-1:00 </u></b> WeeklyUpdate Meetings</td>
        <td><b><u>1:00-2:00 </u></b> MeetingRoom ManagerMeeting</td>
        </tr>
        <tr align="center">
        <td><b><u>4:00-10:00  </u></b> <br>Get-To-Gather</td>
        <td><b><u>4:00-5:00 </u></b>conferencehall-2 </td>
        <td><b><u>9:00-10:00 </u></b> BusinessMeeting</td>
        <td><b><u>9:00-10:00 </u></b> DesignTeam Meeting</td>
        </tr>
</table>
</body>
</html>
