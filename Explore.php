<?php
session_start(); // Start session to access session variables
// Check if user is logged in
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user'] : null;
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
    <link rel="stylesheet" href="explore.css">
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
                    <li class="nav-item"><a class="nav-link" href="#">Explore</a></li>
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

<div class="container-fluid d-flex flex-wrap">
    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/Wohaoxiangzainajianguoni.jpeg" alt="Picture 1">
            <img src="album_art/Fireonrooftop.jpeg" alt="Picture 2">
            <img src="album_art/不问别离.jpg" alt="Picture 3">
            <img src="album_art/很久很久以后.jpg" alt="Picture 4">
        </div>
        <p>Popular C-Pop</p>
    </div>

    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/Guardianofthememory.jpg" alt="Picture 1">
            <img src="album_art/Lullabyofthesea.jpg" alt="Picture 2">
            <img src="album_art/Borntorise.jpg" alt="Picture 3">
            <img src="album_art/Dyadia.jpg" alt="Picture 4">
        </div>
        <p>HoK OST</p>
    </div>

    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/Crazy.jpeg" alt="Picture 1">
            <img src="album_art/DrunkDazed.jpeg" alt="Picture 2">
            <img src="album_art/TickTack.jpg" alt="Picture 3">
            <img src="album_art/Magnetic.jpg" alt="Picture 4">
        </div>
        <p>Popular K-Pop</p>
    </div>

    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/Hypnoticdata.jpg" alt="Picture 1">
            <img src="album_art/onthefloorremoveface.jpg" alt="Picture 2">
            <img src="album_art/ondatbitch.jpg" alt="Picture 3">
            <img src="album_art/dare.jpg" alt="Picture 4">
        </div>
        <p>Popular Dance/Electronic</p>
    </div>

    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/Murderinmymind.jpg" alt="Picture 1">
            <img src="album_art/Metamophosis.jpg" alt="Picture 2">
            <img src="album_art/icouldneverstay.jpg" alt="Picture 3">
            <img src="album_art/Psychogenesis.jpg" alt="Picture 4">
        </div>
        <p>Popular Phonk</p>
    </div>

    <div class="square-grid-container">
        <div class="square-grid">
            <img src="album_art/GOTMain8.jpg" alt="Picture 1">
            <img src="album_art/GOTMain3.jpg" alt="Picture 2">
            <img src="album_art/GOTMain6.jpg" alt="Picture 3">
            <img src="album_art/GOTMain7.jpg" alt="Picture 4">
        </div>
        <p>Game of Thrones OST</p>
    </div>
</div>

    <div class="container-fluid">
    <h1>Moods & genres</h1>
    <div class="genres-grid">
        <div class="genre-box" style="--accent-color: #4a90e2;">Chill</div>
        <div class="genre-box" style="--accent-color: #a64dff;">Focus</div>
        <div class="genre-box" style="--accent-color: #8e44ad;">Sleep</div>
        <div class="genre-box" style="--accent-color: #f39c12;">Bengali</div>
        <div class="genre-box" style="--accent-color: #3498db;">Country & Americana</div>
        <div class="genre-box" style="--accent-color: #27ae60;">Folk & Acoustic</div>
        <div class="genre-box" style="--accent-color: #f1c40f;">Commute</div>
        <div class="genre-box" style="--accent-color: #9b59b6;">Party</div>
        <div class="genre-box" style="--accent-color: #e74c3c;">Workout</div>
        <div class="genre-box" style="--accent-color: #8e44ad;">Bhojpuri</div>
        <div class="genre-box" style="--accent-color: #16a085;">Dance & Electronic</div>
        <div class="genre-box" style="--accent-color: #d35400;">Gujarati</div>
        <div class="genre-box" style="--accent-color: #ff7f50;">Pop</div>
        <div class="genre-box" style="--accent-color: #ffa07a;">Rock</div>
        <div class="genre-box" style="--accent-color: #7fffd4;">Jazz</div>
        <div class="genre-box" style="--accent-color: #00fa9a;">Blues</div>
        <div class="genre-box" style="--accent-color: #b0e0e6;">Indie</div>
        <div class="genre-box" style="--accent-color: #ff6347;">Hip-Hop</div>
        <div class="genre-box" style="--accent-color: #4682b4;">R&B</div>
        <div class="genre-box" style="--accent-color: #e9967a;">Soul</div>
        <div class="genre-box" style="--accent-color: #8a2be2;">Reggae</div>
        <div class="genre-box" style="--accent-color: #deb887;">Punk</div>
        <div class="genre-box" style="--accent-color: #9acd32;">Grunge</div>
        <div class="genre-box" style="--accent-color: #6495ed;">Latin</div>
        <div class="genre-box" style="--accent-color: #ff69b4;">K-Pop</div>
        <div class="genre-box" style="--accent-color: #20b2aa;">Bollywood</div>
        <div class="genre-box" style="--accent-color: #dc143c;">Metal</div>
        <div class="genre-box" style="--accent-color: #ff4500;">Alternative</div>
    </div>
</div>
<br>


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
