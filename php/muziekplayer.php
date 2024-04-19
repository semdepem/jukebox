<?php
include '../inc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/muziekplayer.css">
   
    <title>Jukebox</title>
</head>
<body>
    <nav class="navbar">
        <button class="cool">Login</button>
    </nav>
    <div class="parent">
        <div class="div1" onclick="playMusic()"> RICK ROLL</div>
        <div class="div2">2 </div>
        <div class="div3">3</div>
        <div class="div4"> 4</div>
        <div class="div5">5 </div>
        <div class="div6"> 6</div>
        <div class="div7"> 7</div>
        <div class="div8"> 8</div>
        <div class="div9"> 9</div>
        <div class="div10">10 </div>
        <div class="div11">11 </div>
        <div class="div12">12 </div>
        <div class="div13">LIJST </div>
    </div>  

    <script>
        function playMusic() {
            // Make an AJAX request to your server to fetch the MP3 file
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../php/muziekfetch.php', true); // Update path to your PHP script
            xhr.responseType = 'blob';

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var blob = xhr.response;
                    var url = URL.createObjectURL(blob);

                    // Create an audio element and set its source to the fetched MP3 file
                    var audio = new Audio(url);

                    // Play the audio
                    audio.play();
                }
            };

            xhr.send();
        }
    </script>
</body>
</html>
