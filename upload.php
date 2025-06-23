<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <title>Upload Song and Album Art</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        input[type="file"], input[type="submit"] {
            display: block;
            margin: 10px 0;
        }
        .message {
            text-align: center;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Upload Song and Album Art</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="song_file">Select Song File:</label>
        <input type="file" name="song_file" id="song_file" accept="audio/*">
        
        <label for="album_art">Select Album Art:</label>
        <input type="file" name="album_art" id="album_art" accept="image/*">
        
        <input type="submit" value="Upload">

        <input type="submit" class="btn-submit btn bg-danger" value="Logout" name="Logout">
    </form>

    <?php
    // Define upload directories
    $songUploadDir = "audio/";
    $albumArtUploadDir = "album_art/";

    // Ensure directories exist
    if (!is_dir($songUploadDir)) {
        mkdir($songUploadDir, 0777, true);
    }
    if (!is_dir($albumArtUploadDir)) {
        mkdir($albumArtUploadDir, 0777, true);
    } 

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $messages = [];

        // Validate and process the song file
        if (isset($_FILES['song_file']) && $_FILES['song_file']['error'] === 0) {
            $songFile = $_FILES['song_file'];
            $allowedSongTypes = ['audio/mpeg', 'audio/mp3', 'audio/wav' , 'audio/flac', 'audio/opus'];
            
            if (in_array($songFile['type'], $allowedSongTypes)) {
                $songPath = $songUploadDir . basename($songFile['name']);
                if (move_uploaded_file($songFile['tmp_name'], $songPath)) {
                    $messages[] = "Song uploaded successfully!";
                } else {
                    $errors[] = "Failed to upload song.";
                }
            } else {
                $errors[] = "Invalid song file type.";
            }
        } else {
            $errors[] = "Song file is required.";
        }

        // Validate and process the album art
        if (isset($_FILES['album_art']) && $_FILES['album_art']['error'] === 0) {
            $albumArtFile = $_FILES['album_art'];
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp','image/jpg'];
            
            if (in_array($albumArtFile['type'], $allowedImageTypes)) {
                $albumArtPath = $albumArtUploadDir . basename($albumArtFile['name']);
                if (move_uploaded_file($albumArtFile['tmp_name'], $albumArtPath)) {
                    $messages[] = "Album art uploaded successfully!";
                } else {
                    $errors[] = "Failed to upload album art.";
                }
            } else {
                $errors[] = "Invalid album art file type.";
            }
        } else {
            $errors[] = "Album art file is required.";
        }

        // Display messages or errors
        if (!empty($messages)) {
            echo '<div class="message success">' . implode('<br>', $messages) . '</div>';
        }
        if (!empty($errors)) {
            echo '<div class="message error">' . implode('<br>', $errors) . '</div>';
        }

        if (isset($_POST['Logout'])){
            header("Location: login.php");
            session_destroy();
            exit();
        }
    }
    ?>
</body>
</html>
