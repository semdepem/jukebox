<?php
include('config.php');
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user'])) header('Location: ../admincomments.php');
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <center>
    <h1>Login</h1>
        <?php if (isset($_SESSION['error'])) {
            echo "<p style=color:red>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        } ?>
        <form name="f1" action="login_process.php" method="POST">
            <p>
                <label class="form-label" for="user"> Username: </label>
                <input type="text" id="user" name="user" />
            </p>
            <p>
                <label class="form-label" for="pass"> Password: </label>
                <input type="password" id="pass" name="pass" />
            </p>
            <p>
                <input type="submit" class="btn btn-primary" value="Login" />
            </p>
        </form>
<!--    <a class="btn" href='register.php'>Register</a> -->
    </div>


    <hr class="col-3 col-md-2 mb-5">
    <a href="muziekplayer.php"><button type="button" class="btn btn-outline-light me-2">Terug naar Jukebox</button></a>
    </center>
</body>
</html>

