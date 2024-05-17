<?php
session_start();

// Database connection
$db = new mysqli('localhost', 'db088699', 'banaankaas', '088699_database');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES['mp3_file']) && $_FILES['mp3_file']['error'] === UPLOAD_ERR_OK) {
        $title = $_FILES['mp3_file']['name'];
        $file = $_FILES['mp3_file']['tmp_name'];

        // Move the uploaded file to the "Media" folder
        $targetPath = "Media/" . $title;
        if (move_uploaded_file($file, $targetPath)) {
            // Insert file details into the database
            $stmt = $db->prepare("INSERT INTO songs (title, file) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $targetPath);
            $stmt->execute();
            $stmt->close();

            echo "File uploaded successfully.";
        } else {
            echo "Error moving uploaded file.";
        }
    } else {
        // Check if file upload encountered any errors
        echo "Error uploading file. Error code: " . $_FILES['mp3_file']['error'];
    }
}

// Fetch song names from the database
$songs = [];
$result = $db->query("SELECT title FROM songs");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $songs[] = $row['title'];
    }
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/muziekplayer.css">
    <script src="../javascript/muziekload.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <title>Jukebox</title>
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
      </div>
    </div>
</header>

<div class="parent">
    <?php foreach ($songs as $song): ?>
        <button type="button" class="btn btn-primary song"><?php echo $song; ?></button>
    <?php endforeach; ?>
</div>

    
    <div class="13" id="lijst">Lijst</div>
</div>

<script>
    // JavaScript to handle clicking on a song
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('song')) {
            var songName = e.target.textContent;
            var lijstDiv = document.getElementById('lijst');
            lijstDiv.innerHTML = "<audio controls><source src='../Media/" + songName + "'type='audio/mpeg'></audio>";
        }
    });

    </script>
    </body>
    </html>
