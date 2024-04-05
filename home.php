<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['gebruiker'])){
    ?>
    
    <!DOCTYPE html>
    <html>
        <head>
            <title>Home</title>
            <link rel="stylesheet" href="stylesheet.css">
        </head>
        <body>
            <h1>Hello, <?php echo $_SESSION['gebruiker']; ?></h1>
            <a href="logout.php">Logout</a>
        </body>
    </html>

    <?php
}
else {
    header("Location: index.php");
    exit();
}

?>