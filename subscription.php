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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="subscription.css">
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
                    <li class="nav-item"><a class="nav-link" href="#">Upgrade</a></li>
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

<div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Free Plan</h3>
                        <h4 class="card-title">Price: $0/month</h4><br>
                                <ul type="disc">
                                    <li>Limited skips</li>
                                    <li>Ads every few songs</li>
                                    <li>Standard audio quality (up to 128 kbps)</li>
                                    <li>Access to playlists and radio stations</li>
                                    <li>Limited offline downloads</li>
                                </ul>
                        <a href="subscriptionform.php" class="button">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Student Plan</h3>
                        <h4 class="card-title">Price: $4.99/month</h4><br>
                                <ul type="disc">
                                    <li>No ads</li>
                                    <li>Unlimited skips</li>
                                    <li>High audio quality (up to 256 kbps)</li>
                                    <li>Offline downloads</li>
                                    <li>Limited to students with verification</li>
                                    <li>Access to exclusive student playlists</li>
                                </ul>
                        <a href="subscriptionform.php" class="button">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Solo Plan</h3>
                        <h4 class="card-title">Price: $7.99/month</h4><br>
                                <ul type="disc">
                                    <li>No ads</li>
                                    <li>Unlimited skips</li>
                                    <li>High audio quality (up to 256 kbps)</li>
                                    <li>Offline downloads for up to 3 devices</li>
                                    <li>Curated recommendations based on listening habits.</li>
                                </ul>
                        <a href="subscriptionform.php" class="button">Get Started</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Family Plan</h3>
                        <h4 class="card-title">Price: $14.99/month</h4><br>
                                <ul type="disc">
                                    <li>No ads</li>
                                    <li>Up to 6 accounts</li>
                                    <li>Unlimited skips</li>
                                    <li>High audio quality (up to 256 kbps)</li>
                                    <li>Individual playlists and recommendations</li>
                                    <li>Shared family playlists</li>
                                    <li>Parental controls for younger members</li>
                                    <li>Offline downloads</li>
                                </ul>
                        <a href="subscriptionform.php" class="button">Get Started</a>
                    </div>
                </div>
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
