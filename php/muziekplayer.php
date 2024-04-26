<?php
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/muziekplayer.css">
    <script src="../javascript/muziekload.js"></script>
    <title>Jukebox</title>
</head>
<body>
    <nav class="navbar">
        <button class="cool">Login</button>
        <button class="upload"><a href="../php/uploader.php">upload</a></button>
    </nav>
    <div class="parent">
        <?php foreach ($songs as $song): ?>
            <div class="song"><?php echo $song; ?></div>
        <?php endforeach; ?>
        
    <div class="13" id="lijst">Lijst</div>

    </div>

    <script>
        // JavaScript to handle clicking on a song
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('song')) {
        var songName = e.target.textContent;
        var lijstDiv = document.getElementById('lijst');
        lijstDiv.innerHTML = "<audio controls><source src='../Media/" + songName + "' type='audio/mpeg'></audio>";
    }
});
    </script>
</body>
</html>
