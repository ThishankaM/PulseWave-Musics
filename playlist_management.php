<?php
session_start();
require_once "databasecon.php";

$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user'] : null;

// Validate session user ID
if (!isset($_SESSION['id'])) {
    echo "User is not logged in.";
    exit;
}
$user_id = $_SESSION['id'];

// Fetch all songs
$songs = [];
$songs_result = $conn->query("SELECT * FROM music");
if ($songs_result) {
    $songs = $songs_result->fetch_all(MYSQLI_ASSOC);
}

// Create a new playlist
if (isset($_POST['create_playlist'])) {
    $playlist_name = $_POST['playlist_name'];
    $stmt = $conn->prepare("INSERT INTO playlists (user_id, name) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $playlist_name);
    if ($stmt->execute()) {
        $playlist_id = $stmt->insert_id;
        header("Location: playlist_management.php?playlist_id=$playlist_id");
        exit();
    } else {
        echo "Error creating playlist: " . $stmt->error;
    }
}

// Add a song to a playlist
if (isset($_POST['add_to_playlist'])) {
    $playlist_id = $_POST['playlist_id'];
    $song_id = $_POST['song_id'];
    $stmt = $conn->prepare("INSERT INTO playlist_songs (playlist_id, song_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $playlist_id, $song_id);
    if ($stmt->execute()) {
        header("Location: playlist_management.php?view_playlist=$playlist_id");
        exit();
    } else {
        echo "Error adding song: " . $stmt->error;
    }
}

// Remove a song from a playlist
if (isset($_POST['remove_from_playlist'])) {
    $playlist_id = $_POST['playlist_id'];
    $song_id = $_POST['song_id'];
    $stmt = $conn->prepare("DELETE FROM playlist_songs WHERE playlist_id = ? AND song_id = ?");
    $stmt->bind_param("ii", $playlist_id, $song_id);
    if ($stmt->execute()) {
        header("Location: playlist_management.php?view_playlist=$playlist_id");
        exit();
    } else {
        echo "Error removing song: " . $stmt->error;
    }
}

// Delete a playlist
if (isset($_POST['delete_playlist'])) {
    $playlist_id = $_POST['playlist_id'];

    // Delete songs in the playlist first to maintain database integrity
    $conn->query("DELETE FROM playlist_songs WHERE playlist_id = $playlist_id");

    // Delete the playlist
    $stmt = $conn->prepare("DELETE FROM playlists WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $playlist_id, $user_id);
    if ($stmt->execute()) {
        echo "Playlist deleted successfully!";
        header("Location: Library.php");
        exit();
    } else {
        echo "Error deleting playlist: " . $stmt->error;
    }
}

// Fetch songs in a playlist
$playlist_songs = [];
if (isset($_GET['view_playlist'])) {
    $playlist_id = $_GET['view_playlist'];
    $playlist_songs_result = $conn->query("
        SELECT music.* FROM music
        INNER JOIN playlist_songs ON music.id = playlist_songs.song_id
        WHERE playlist_songs.playlist_id = $playlist_id
    ");
    if ($playlist_songs_result) {
        $playlist_songs = $playlist_songs_result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Error fetching songs: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src = "js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="playmana.css">
    <title>Playlist Management</title>
</head>
<body>
</head>
<body>
<div class="navbar-section">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"> PulseWave </a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Artists.php">Artists</a></li>
                    <li class="nav-item"><a class="nav-link" href="Explore.php">Explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="Library.php">Library</a></li>
                    <li class="nav-item"><a class="nav-link" href="subscription.php">Upgrade</a></li>
                </ul>
                <div class="icon-group ms-auto d-flex">
                    <?php if ($isLoggedIn): ?>
                        <a href="profile.php" class="btn btn-outline-light me-2">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                        </a>
                        <a href="logout.php" class="btn btn-outline-light">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-light me-2">
                            <i class="fas fa-user"></i> Login & Signup
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<music-search></music-search>
<script src="search.js"></script>

<div class="container-fluid">
    <div class="container2">
        <div class="inside-container">
    <?php if (isset($_GET['playlist_id']) || isset($_GET['view_playlist'])): ?>

        <h4>Songs in Playlist</h4>
        <ul>
            <?php if (!empty($playlist_songs)): ?>
                <?php foreach ($playlist_songs as $song): ?>
                    <li class="list">
                        <?= htmlspecialchars($song['title']); ?> - <?= htmlspecialchars($song['artist']); ?>
                        <form method="POST" action="playlist_management.php" style="display:inline;">
                            <input type="hidden" name="playlist_id" value="<?= htmlspecialchars($_GET['view_playlist']); ?>">
                            <input type="hidden" name="song_id" value="<?= htmlspecialchars($song['id']); ?>">
                            <button type="submit" name="remove_from_playlist" class="btn">-</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No songs in this playlist yet.</p>
            <?php endif; ?>
        </ul>

        <h4>Add Songs to Playlist</h4>
        <ul>
            <?php foreach ($songs as $song): ?>
                <li class="list">
                    <?= htmlspecialchars($song['title']); ?> - <?= htmlspecialchars($song['artist']); ?>
                    <form method="POST" action="playlist_management.php" style="display:inline;">
                        <input type="hidden" name="playlist_id" value="<?= htmlspecialchars($_GET['playlist_id'] ?? $_GET['view_playlist']); ?>">
                        <input type="hidden" name="song_id" value="<?= htmlspecialchars($song['id']); ?>">
                        <button type="submit" name="add_to_playlist" class="btn">+</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
