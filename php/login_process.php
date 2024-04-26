<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';

// Start session
session_start();

// Connect to MySQL database
$conn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Retrieve hashed password, Rekeningnummer, Balance, and Savings from the database based on email
    $query_select_user = "SELECT * FROM login WHERE username='$username'";
    $result = mysqli_query($conn, $query_select_user);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Set session variables
            $_SESSION['username'] = $row['username']; // Store Savings in session
            
            // Redirect to dashboard or desired page
            header("Location: muziekplayer.php");
            exit();
        } else {
            header("Location: login.php");
            $error_message = "Incorrect username or password.";
            exit();
        }
    } else {
        header("Location: login.php");
        $error_message = "Incorrect username or password.";
        exit();
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if(isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
