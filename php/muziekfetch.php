<?php
// Include your database connection file
include '../inc/config.php';

// Check if the ID parameter is provided in the request
if (isset($_GET['id'])) {
    // Sanitize the ID parameter
    $id = $_GET['id'];

    // Prepare and execute a query to fetch the MP3 file from the database based on the provided ID
    $stmt = $pdo->prepare("SELECT mp3_bestand FROM muziek WHERE id = 3");
    $stmt->execute([$id]);

    // Fetch the MP3 file data
    $mp3Data = $stmt->fetchColumn();

    // Set the appropriate headers for the response
    header('Content-Type: audio/mpeg');
    header('Content-Length: ' . strlen($mp3Data));

    // Output the MP3 file data
    echo $mp3Data;
} else {
    // If ID parameter is not provided, return an error response
    http_response_code(400);
    echo "ID parameter is missing.";
}
?>
