<?php
$servername = "srv544.hstgr.io";
$db_username = "u745359346_WDIAPR24T3";
$db_password = "WDIAPR24Team3.Calanjiyam@2024";
$dbname = "u745359346_WDIAPR24T3";$port = 3306;
//echo "uploaded successfully!";
// Debugging: Check if the credentials are correctly assigned
// Uncomment these lines to debug (Not recommended in a production environment)
// echo "DB Username: " . $db_username . "<br>";
// echo "DB Password: " . $db_password . "<br>";

$conn = new mysqli($servername, $db_username, $db_password, $dbname,$port);
if($conn->connect_error){
  die("Connection failed :" .$conn-> connect_error);
  }
  if(isset($_POST['submit'])) {
    //echo "1";
    $name=$_POST['Event_Name'];
    $date=$_POST['Date'];
    $time= $_POST['Time'];
    $venue=$_POST['Venue'];
    $file_name = $_FILES['Image']['name'];
    $tempname =$_FILES['Image']['tmp_name'];
    $folder="C:/xampp/htdocs/VMS Project/image_uploaded_files/";
   // echo "uploaded successfulllly!";
    $sql = ("INSERT INTO UE_Page (Event_Name, Date, Time , Venue ,Image)
            VALUES ('$name', '$date', '$time', '$venue','$file_name')");
    //echo "uploaded successfully!";
     if ($conn->query($sql) === TRUE) {
      echo "uploaded successfully!";
     } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
     }
     
     // $folder = 'Images/'.$file_name;
      //$query = mysqli_query($conn, "Insert into Venues_Page (Image) values ('$file_name')");
      if(move_uploaded_file($tempname, $folder.$file_name)) {
      echo "<h2>File uploaded successfully</h2>";
      } else {
       echo "<h2>File not uploaded</h2>";
      }
  }
  //echo "2";

?>


<!DOCTYPE html>
<!-- saved from url=(0048)file:///C:/Users/hp/OneDrive/Desktop/VMS/ue.html -->
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upcoming Events</title>
  <link href="a_upcoming_events.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/9379645876.js" crossorigin="anonymous"></script>
</head>
<body>
  <script src="a_upcoming_events.js"></script> 
  <header class="head">
    <a class ="logo">Logo</a>
    <div class="search-bar">
        <input type="text" placeholder="Search for Venues">
        <a href="#">
            <i class="fa-solid fa-magnifying-glass"></i>
        </a>
    </div>
    <nav class="navigation">
        <a href ="a_ven.php">Venue</a>
        <a class="active" href ="a_upcoming_events.php">Upcoming Events</a>
        <a href ="a_notification.php">Notification</a>
        <a href ="a_settings.html">Settings</a>
        <a href ="index.html">Logout</a>
    </nav>
  </header><br><br><br><br><br><br><br><br>
  <div id="NEWEvent-form" style="display: none;">
    <h2>Add New Event</h2>
    <a href="#" class="close-form-icon">
        <i class="fa-solid fa-xmark"></i> 
    </a>
    <form id="Event-form-data" method="post" enctype = "multipart/form-data">
      <label for="Event-name">Event Name:</label>
      <input type="text" id="event-name" name="Event_Name" required>
  
      <label for="Date">Date:</label>
      <input type="date" id="date" value="Enter date" name="Date" required>
  
      <label for="Time">Time:</label>
      <input type="time" id="time" name="Time" required>

      <label for="Venue-name">Venue:</label>
      <input type="text" id="venue-name" value="VenueName" name="Venue" required>

      <label for="Imagepath">Image Path</label>
      <input type="file" id="File" value="Upload file" name="Image" required>
      <br>
      <button type="submit" name="submit">Submit</button>
    </form>
</div>


    <div class="upcoming-events">
      <h1 class="centered-heading">Upcoming Events</h1><br>
      <div class="event-container">
        
        <?php
                  
                  $res=mysqli_query($conn,"select * from UE_Page");
                  
                  while($row=mysqli_fetch_assoc($res)){
                    $org_file_name ="image_uploaded_files/".$row['Image'];
                    //echo $org_file_name;
                  ?>
                  <div class="event">
                  <img src="<?php echo $org_file_name ;?>"/>
                  
                  
              
                 
                      <h2><?php echo $row["Event_Name"] ?> </h2>
                      <p><?php echo $row["Date"] ?></p>
                      <p><?php echo $row["Time"] ?></p>
                      <p><?php echo $row["Venue"] ?></p>
                  </div>
                  <?php
                  }
                  ?></div></div>
        <!--0 <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTpJ1ExE5_J8lWvp2RdF2lo-fU1muRu6F8Ig&s">
          <h2>Business Conference</h2><br>
          <p>Date: May 15, 2024</p>
          <p>Time: 10:00 AM - 5:00 PM</p>
          <p>Venues: Conference Room </p>
        </div>
        <div class="event">
          <img src="data:image/jpeg;base64,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">
          <h2>Corporate Meetings</h2><br>
          <p>Date: May 22, 2024</p>
          <p>Time: 2:00 PM - 8:00 PM</p>
          <p>Venues: Meeting Hall</p>
        </div>
        <div class="event">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9pMctgmmVL2nUVculDsY-DZ5srEwM3Hk-dQ&s">
          <h2>Corporate Seminar</h2><br>
          <p>Date: May 29, 2024</p>
          <p>Time: 6:00 PM - 12:00 AM</p>
          <p>Venues: Auditorium</p>
        </div>
        <div class="event">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTH6y0UNGg3-55ZpUw0aT0bfGA0IKgJx98nLw&s">
            <h2>Award Functions</h2><br>
            <p>Date: May 29, 2024</p>
            <p>Time: 6:00 PM - 12:00 AM</p>
            <p>Venues: Corporate Hall</p>
          </div>
          <div class="event">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRQwYcmXcCxJo6VKXwMwyG_8E9rSD8xogv9VQ&s">
            <h2>Corporate Parties</h2><br>
            <p>Date: May 29, 2024</p>
            <p>Time: 6:00 PM - 12:00 AM</p>
            <p>Venues: Party Hall</p>
          </div>
      </div>
    </div>   -->
    <button id = "AddNew">Add New Event</button>
</body>
</html>