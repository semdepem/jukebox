<?php
include('../inc/config.php');
session_start();

if (!empty($_POST)) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $query = "SELECT * FROM login WHERE username = '$username'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if (password_verify($password, $row['password'])) {
        $_SESSION['message'] = "Successfully logged in";

        $_SESSION['id'] = $row['ID'];
        $_SESSION['user'] = $row['username'];

        // Set the logged_in session variable to true
        $_SESSION['logged_in'] = true;

        header('Location: muziekplayer.php');
    } else {
        $_SESSION['error'] = 'Error: Incorrect Password or Username.';
    }
}
?>
