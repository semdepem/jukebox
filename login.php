<?php
session_start();
include('db_conn.php');

if(isset($_POST['uname']) && isset($_POST['password'])){

    function validation($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

$uname = validation($_POST['uname']);
$pass = validation($_POST['password']);

if(empty($uname)) {
    header ("Location: index.php?error=User Name is required");
    exit();
}
else if (empty($pass)){
    header("Location: index.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM login WHERE username='$uname' AND password='$pass'";

$result = mysqli_query($mysqli, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['username'] ===  $uname && $row['password'] === $pass) {
        echo "Logged in!!";
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    }
    else {
        header("Location: index.php?error=Incorrect User name or Password");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}
?>