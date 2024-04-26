<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/upload.css">
    <title>Upload</title>
</head>
<body>
    <nav class="navbar">
            <button class="home"><a href="../php/muziekplayer.php">Home</button>
    </nav>


    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="mp3_file" />
        <input type="submit" value="Upload" />
    </form>
</body>
</html>




