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
        $targetPath = "../Media/" . $title;
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
?>
