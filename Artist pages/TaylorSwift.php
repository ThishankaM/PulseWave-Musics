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
    <link rel="stylesheet" href="../css\bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src = "../js\bootstrap.min.js"></script>
    <link rel="stylesheet" href="artistpage.css">
    <title>Document</title>
    <style>
        body {
            background-image: 
                linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, black 100%), 
                url('../Artist_art/taylorswift.jpg'); 
            background-size: cover; 
            background-repeat: no-repeat; 
            background-position: center;
        }
        @media (max-width: 768px) {
                body {
                    background-size: auto 300px;
                    background-color: black;
                    background-position: top;
                    }
            }
    </style>
</head>
<body>

<div class="navbar-section">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"> PulseWave </a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../Artists.php">Artists</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Explore.php">Explore</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Library.php">Library</a></li>
                    <li class="nav-item"><a class="nav-link" href="../subscription.php">Upgrade</a></li>
                </ul>
                <div class="icon-group ms-auto d-flex">
                    <?php if ($isLoggedIn): ?>
                        <a href="../profile.php" class="btn btn-outline-light me-2">
                            <i class="fas fa-user"></i> <?php echo htmlspecialchars($username); ?>
                        </a>
                        <a href="../logout.php" class="btn btn-outline-light">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    <?php else: ?>
                        <a href="../login.php" class="btn btn-outline-light me-2">
                            <i class="fas fa-user"></i> Login & Signup
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="Search-Container">
    <input type="text" class="search-input" placeholder ="Search Music">
</div>

<div class="container-details">
    <h1>Taylor Swift</h1><br>
    
    <button><i class='bx bx-play' ></i> Play</button>
    <button><i class='bx bx-shuffle' ></i> Shuffle</button>
    <button><i class='bx bx-heart'></i> Follow</button>
</div>

<br>

<div class="music-grid">
    <div class="card">
      <img src="../album_art/love_story.jpg" alt="Love Story" class="cover">
      <div class="info">
        <h3>Love Story</h3>
        <p>Single • 2008</p>
      </div>
    </div>
    <div class="card">
      <img src="../album_art/blank_space.jpg" alt="Shake It Off" class="cover">
      <div class="info">
        <h3>Shake It Off</h3>
        <p>Single • 2014</p>
      </div>
    </div>
    <div class="card">
      <img src="../album_art/blank_space.jpg" alt="Blank Space" class="cover">
      <div class="info">
        <h3>Blank Space</h3>
        <p>Single • 2014</p>
      </div>
    </div>
    <div class="card">
      <img src="../album_art/cardigan.jpg" alt="Cardigan" class="cover">
      <div class="info">
        <h3>Cardigan</h3>
        <p>Single • 2020</p>
      </div>
    </div>
    <div class="card">
      <img src="../album_art/Wildest_Dream.jpg" alt="Wildestdream" class="cover">
      <div class="info">
        <h3>Wildest Dream</h3>
        <p>Single • 2020</p>
      </div>
    </div>
</div>


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
