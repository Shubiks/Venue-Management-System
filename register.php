<?php
session_start();
include 'connect.php';

if (isset($_POST['login_form'])) {
    $loginInput = $_POST['name'];
    $password = md5($_POST['password']);
    $account_type = $_POST['account_type'];

    if ($account_type == 'admin') {
        $sql = "SELECT * FROM admins WHERE (name = ? OR email = ?) AND password = ?";
    } else {
        $sql = "SELECT * FROM users WHERE (name = ? OR email = ?) AND password = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $loginInput, $loginInput, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user'] = $loginInput;
        $_SESSION['account_type'] = $account_type;

        if ($account_type == 'admin') {
            header("Location: a_home.html");
        } else {
            header("Location: home.php");
        }
    } else {
        echo "Invalid credentials";
    }
}

if (isset($_POST['signup_form'])) {
    $signup_name = $_POST['signup_name'];
    $signup_email = $_POST['signup_email'];
    $signup_pass = md5($_POST['signup_pass']);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $signup_name, $signup_email, $signup_pass);
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
