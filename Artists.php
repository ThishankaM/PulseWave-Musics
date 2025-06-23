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
    <link rel="stylesheet" href="Artist.css">
    

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
                    <li class="nav-item"><a class="nav-link" href="#">Artists</a></li>
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
<script src="searchartist.js"></script>

<div class="Container-fluid">

    <a href="Artist pages\JenniferLopez.php">
        <div class="image-container">
            <img src="Artist_art\JenniferLopez.2jpg.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Rose.php">
        <div class="image-container">
            <img src="Artist_art\Rose2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Yuri.php"> 
        <div class="image-container">
            <img src="Artist_art\Yuri2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Sing.php">
        <div class="image-container">
            <img src="Artist_art\寄明月.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Kordell.php">
        <div class="image-container">
            <img src="Artist_art\Kordell2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\LiSA.php">
        <div class="image-container">
            <img src="Artist_art\LiSA2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\CarlyRaeJepsen.php">
        <div class="image-container">
            <img src="Artist_art\CarlyRaeJepsen2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Weekend.php">
        <div class="image-container">
            <img src="Artist_art\weekend2.jpeg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\TaylorSwift.php">
        <div class="image-container">
            <img src="Artist_art\taylorswift2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Ironmouse.php"> 
        <div class="image-container">
            <img src="Artist_art\ironmouse2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Reol.php">
        <div class="image-container">
            <img src="Artist_art\Reol2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\ado.php">
        <div class="image-container">
            <img src="Artist_art\ado2.jpeg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Arianagrande.php">
        <div class="image-container">
            <img src="Artist_art\Arianagrande2.jpg" alt="Image">
        </div>
    </a>

    <a href="Artist pages\Maroon5.php">
        <div class="image-container">
            <img src="Artist_art\maroon52.jpg" alt="Image">
        </div>
    </a>


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
