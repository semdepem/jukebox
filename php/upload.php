<?php
// Database connection
$db = new mysqli('localhost', 'db088699', 'banaankaas', '088699_database');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_FILES['mp3_file']['name'];
    $file = file_get_contents($_FILES['mp3_file']['tmp_name']);

    $stmt = $db->prepare("INSERT INTO songs (title, file) VALUES (?, ?)");
    $stmt->bind_param("sb", $title, $file);
    $stmt->execute();
    $stmt->close();

    echo "File uploaded successfully.";
}
?>
