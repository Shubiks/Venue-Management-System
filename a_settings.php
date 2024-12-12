<?php
$servername = "srv544.hstgr.io";
$db_username = "u745359346_WDIAPR24T3";
$db_password = "WDIAPR24Team3.Calanjiyam@2024";
$dbname = "u745359346_WDIAPR24T3";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['UserName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Sanitize input data to prevent SQL injection
    function sanitize_input($data,$conn) {
    return htmlspecialchars(mysqli_real_escape_string($conn, $data));
}
    // Sanitize input to prevent SQL injection
    $name =sanitize_input($_POST['UserName'],$conn);
    $email =sanitize_input($_POST['Email'],$conn);
    $password = sanitize_input($_POST['Password'],$conn);
   
    // Update user information in the database
    $sql = "UPDATE users SET name='$name', email='$email', password='$password' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>