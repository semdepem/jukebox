<?php
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.css">
    <title>Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->
</head>
<body>
<header class="p-3 text-bg-primary">
<div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="muziekplayer.php"><button type="button" class="btn btn-outline-light me-2">Home</button></a></li>
        
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                echo '<div class="text-end">';
                echo '<a href="uploader.php"><button type="button" class="btn btn-outline-light me-2">Upload</button></a>';
                echo '<a href="logout.php"><button type="button" class="btn btn-outline-light me-2">Logout</button></a>';
                echo '</div>';
            } else {
                // Show the "Login" link when not logged in
                echo '<div class="text-end">';
                echo '<a href="login.php"><button type="button" class="btn btn-outline-light me-2">Login</button></a>';
                echo '</div>';
            }
        ?>
        </ul>
        </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form id="uploadForm" enctype="multipart/form-data" class="bg-dark p-4 rounded">
                    <div class="mb-3">
                        <label for="mp3_file" class="form-label">Choose MP3 file</label>
                        <input type="file" name="mp3_file" id="mp3_file" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Upload" class="btn btn-primary w-100" />
                    </div>
                </form>
                <!-- Div to display upload status -->
                <div id="uploadStatus"></div>
            </div>
        </div>
    </div>

    <!-- Script to handle form submission via AJAX -->
    <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#uploadStatus').html(response); // Show upload status
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors to the console
                    }
                });
            });
        });
    </script>
</body>
</html>
