<?php
require_once 'databasecon.php';
// Fetch music files from the database
$sql = "SELECT id, title, artist, file_path, album_art FROM music";
$result = $conn->query($sql);

$music = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $music[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'artist' => $row['artist'],
            'file_path' => $row['file_path'],
            'album_art' => $row['album_art']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($music);

$conn->close();
?>
