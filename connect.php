<!-- 
    $servername = "srv544.hstgr.io";
    $username = "u745359346_WDIAPR24T3";
    $password = "WDIAPR24Team3.Calanjiyam@2024";
    $dbname = "u745359346_WDIAPR24T3";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dynamic_creation";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";

    $conn = new mysqli($servername,$username,$password,$dbname,3307);

    if ($conn->connect_error) {
      echo "Error:".$conn->error;
      } -->


<?php
    $servername = "srv544.hstgr.io";
    $username = "u745359346_WDIAPR24T3";
    $password = "WDIAPR24Team3.Calanjiyam@2024";
    $dbname = "u745359346_WDIAPR24T3";
    $port = 3306;

    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
