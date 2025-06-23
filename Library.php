<?php
session_start(); // Start session to access session variables
// Check if user is logged in
require_once "databasecon.php"; // Include database connection file
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user'] : null;

// Validate session user ID
if (!isset($_SESSION['id'])) {
    header("Location: Login.php");
    exit;
}
$user_id = $_SESSION['id'];

// Fetch playlists
$playlists = [];
$result = $conn->query("SELECT * FROM playlists WHERE user_id = $user_id");
if ($result) {
    $playlists = $result->fetch_all(MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="library.css">
    <title>Document</title>
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
                    <li class="nav-item"><a class="nav-link" href="#">Library</a></li>
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

<div class="Playlist-Container">
    <form method="POST" action="playlist_management.php">
        <input type="text" name="playlist_name" placeholder="Playlist Name" required>
        <button type="submit" name="create_playlist" class="create-button">Create</button><br>
        <h3>Your Playlists</h3>
    </form>

    <div class="Playlists">
        <?php
        $playlists_result = $conn->query("SELECT * FROM playlists WHERE user_id = $user_id");
        if ($playlists_result) {
            while ($playlist = $playlists_result->fetch_assoc()) {
                echo "<li class='play-items'>";
                echo "<a href='playlist_management.php?view_playlist=" . htmlspecialchars($playlist['id']) . "'>";
                echo htmlspecialchars($playlist['name']);
                echo "</a>";
                echo " <form method='POST' action='playlist_management.php' style='display:inline;'>
                    <input type='hidden' name='playlist_id' value='" . htmlspecialchars($playlist['id']) . "'>
                    <button type='submit' name='delete_playlist' class ='delete-btn'><i class='bx bx-trash'></i></button>
                    </form>";
                echo "</li>";
                }
            } else {
                echo "Error fetching playlists: " . $conn->error;
            }
        ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();
            const playlists = document.querySelectorAll('.play-items');
            playlists.forEach(function(playlist) {
                const playlistName = playlist.textContent.toLowerCase();
                if (playlistName.includes(query)) {
                    playlist.style.display = '';
                } else {
                    playlist.style.display = 'none';
                }
            });
        });
    });
</script>




<footer class="footer text-center">
    <div class="container">
        <p class="mb-0">All Rights Reserved</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#" class="text-white" style="text-decoration: none;">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="#" class="text-white" style="text-decoration: none;">Terms of Condition</a></li>
            <li class="list-inline-item"><a href="#" class="text-white" style="text-decoration: none;">Contact</a></li>
        </ul>
    </div>
</footer>


</body>
</html>
