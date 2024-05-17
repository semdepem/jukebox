<?php
session_start();
//var_dump($_SESSION); // Output session data for debugging


// Check if there's a login error message
$login_error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); // Clear the error message

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <center>
    <h2>User Login</h2>
    <?php if (!empty($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form action="login_process.php" method="post">
        <label class="form-label" for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label class="form-label" for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" class="btn btn-primary" value="Login">
    </form>

    <hr class="col-3 col-md-2 mb-5">

    <a href="register.php" class="btn btn-primary">Register</a>
    </center>
</body>
</html>

