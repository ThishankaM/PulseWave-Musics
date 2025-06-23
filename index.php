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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src = "js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="index.css">
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
    <div class="container-carousel">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#carousel" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Artist_art\Yuri.jpg" class="d-block w-100" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                <h3>Yuri – A New Voice in J-Pop</h3>
                <p>Captivating hearts with her soulful voice and ethereal presence.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Artist_art\TheWeekend.jpg" class="d-block w-100" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                <h3>The Weeknd – The Voice of an Era</h3>
                <p>Master of evocative lyrics and mesmerizing melodies.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Artist_art\Rose.jpg" class="d-block w-100" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                <h3>Rosé – BlackPink's Songbird</h3>
                <p>Enchanting the world with her heartfelt tunes and unique style.</p>
                </div>
            </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="track-container">
        <div id="tracks-container" class="music-tracks"></div>
    </div>
</div>

<div class="container-fluid">
    <div class="player">
        <marquee id="song-title" style="font-size:35px;">PulseWave Player</marquee>
            <audio id="audio-player"></audio>
                <div class="album-art-container">
                    <img id="album-art" src = "default-album-art.jpg" class="album-art">
                </div>
                <div id="timeline" style = "margin-bottom:-1px; margin-top:-10px;">
                <div id="progress"></div>
                </div>
                <span id="current-time">0:00</span>
                <span id="duration" class="duration" style="margin-left:365px;">0:00</span>
           
            <div id="track-list"></div>
            <div id="music-controls">
                    <audio id="audio-player"></audio>
                    <button style="background: transparent; border: none; margin-right:10px; margin-top:-15px "><box-icon name='repost' size="md" ></box-icon></button>
                    <button id ="previousBtn"style="background: transparent; border: none; margin-right:10px; margin-top:-15px "><box-icon name='skip-previous' size="md" ></box-icon></button>
                    <button id="play-btn"style="background: transparent; border: none; margin-right:10px;margin-top:-15px "><box-icon name='play' size="md" ></box-icon></button>
                    <button id="pause-btn"style="background: transparent; border: none; margin-right:10px;margin-top:-15px "><box-icon name='pause' size="md"></box-icon></button>
                    <button id="stop-btn"style="background: transparent; border: none; margin-right:10px;margin-top:-15px "><box-icon name='stop' size="md"></box-icon></box-icon></button>
                    <button id="nextBtn"style="background: transparent; border: none; margin-right:10px;margin-top:-15px "><box-icon name='skip-next' size="md"></box-icon></button>
                    <button style="background: transparent; border: none;margin-top:-15px "><box-icon name='heart' size="sm"></box-icon><br></button>
            </div>
    </div>
</div>

<script src="index.js"></script>

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
