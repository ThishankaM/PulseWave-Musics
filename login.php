<?php
// Start the session
session_start();
require_once "databasecon.php";

// Define variables and initialize error messages
$name = $password = $confirm_password = $email = "";
$nameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Function to sanitize user inputs
function input($data) {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// Handle form submission with POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $action = $_POST['action'] ?? ''; 

    // Handle sign-up
    if ($action == 'signup') {
        // Validate Name
        if (empty($_POST['name'])) {
            $nameErr = "Name is required";
        } else {
            $name = input($_POST['name']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white spaces allowed";
            }
        }

        // Validate Email
        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $email = input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate Password
        if (empty($_POST['password'])) {
            $passwordErr = "Password is required";
        } else {
            $password = input($_POST['password']);
            if (strlen($password) < 8) {
                $passwordErr = "Password must have at least 8 characters";
            }
        }

        // Validate Confirm Password
        if (empty($_POST['confirm_password'])) {
            $confirmPasswordErr = "Confirm Password is required";
        } else {
            $confirm_password = input($_POST['confirm_password']);
            if ($password !== $confirm_password) {
                $confirmPasswordErr = "Passwords do not match";
            }
        }

        // If no errors, proceed to database insertion
        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
            $email = $conn->real_escape_string($email);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO logins (name, email, password, Usertype) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                echo "Account created successfully";
                header("Location: login.php");
                exit();
            } else {
                echo "Error: {$stmt->error}";
            }
            $stmt->close();
        }
    } elseif ($action == 'signin') {
        // Validate Email for sign-in
        if (empty($_POST['email'])) {
            $emailErr = "Email is required";
        } else {
            $email = input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        // Validate Password for sign-in
        if (empty($_POST['password'])) {
            $passwordErr = "Password is required";
        } else {
            $password = input($_POST['password']);
        }

        // If no errors, proceed to database verification
        if (empty($emailErr) && empty($passwordErr)) {
            $stmt = $conn->prepare("SELECT * FROM logins WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) { // Compare password with hashed password
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $row['name'];
                    $_SESSION['usertype'] = $row['Usertype']; // Store usertype in session

                    // Redirect based on Usertype
                    if ($row['Usertype'] === 'user') {
                        header("Location: index.php");
                    } elseif ($row['Usertype'] === 'artist') {
                        header("Location: upload.php");
                    }
                    exit();
                } else {
                    echo "Invalid password";
                }
            } else {
                echo "No user found with this email";
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="path-to-your-favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="SignIn&Up.css">
    <title>Sign In & Sign Up Portal</title>
</head>
<body>
    <div class="container" id="main">
        <div class="sign-up">
            <form action="" method="POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="https://web.facebook.com/login.php/?_rdc=1&_rdr" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://accounts.google.com/v3/signin/identifier" class="social"><i class="fab fa-google-plus-g"></i></a>
                </div>
                <p>or use your email for registration</p>
                <input type="text" name="name" placeholder="Name" required aria-label="Name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="error"><?php echo $nameErr; ?></span>
                <input type="email" name="email" placeholder="Email" required aria-label="Email" value="<?php echo htmlspecialchars($email); ?>">
                <span class="error"><?php echo $emailErr; ?></span>
                <input type="password" name="password" placeholder="Password" required aria-label="Password">
                <span class="error"><?php echo $passwordErr; ?></span>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required aria-label="Confirm Password">
                <span class="error"><?php echo $confirmPasswordErr; ?></span>
                <button type="submit" name="action" value="signup" aria-label="Sign Up Button">Sign Up</button>
            </form>
        </div>
        <div class="sign-in">
            <form action="" method="POST">
                <h1>Sign In</h1>
                <div class="social-container">
                    <a href="https://web.facebook.com/login.php/?_rdc=1&_rdr" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://accounts.google.com/v3/signin/identifier" class="social"><i class="fab fa-google-plus-g"></i></a>
                </div>
                <p>Already have an account?</p>
                <input type="email" name="email" placeholder="Email" required aria-label="Email">
                <span class="error"><?php echo $emailErr; ?></span>
                <input type="password" name="password" placeholder="Password" required aria-label="Password">
                <span class="error"><?php echo $passwordErr; ?></span>
                <a href="#">Forgot Password?</a>
                <button type="submit" name="action" value="signin" aria-label="Sign In Button">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-left">
                    <h1>Welcome Back</h1>
                    <p>To keep connected with us, please login with your personal information.</p>
                    <button id="signIn">Sign In</button>
                </div>
                <div class="overlay-right">
                    <h1>Hello, Welcome to PulseWave!</h1>
                    <p>Enter your personal details and start your journey with us.</p>
                    <button id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpBtn = document.getElementById('signUp');
        const signInBtn = document.getElementById('signIn');
        const main = document.getElementById('main');
        
        signUpBtn.addEventListener('click', () => {
            main.classList.add("right-panel-active");
        });
        signInBtn.addEventListener('click', () => {
            main.classList.remove("right-panel-active");
        });
        document.querySelectorAll('input[type="password"]').forEach(passwordField => {
            const toggle = document.createElement('span');
            toggle.textContent = 'Show';
            toggle.style.cursor = 'pointer';
            toggle.style.marginLeft = '10px';
            toggle.style.color = '#4b3f6e';
            toggle.addEventListener('click', () => {
                passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
                toggle.textContent = toggle.textContent === 'Show' ? 'Hide' : 'Show';
            });
            passwordField.parentNode.insertBefore(toggle, passwordField.nextSibling);
        });
    </script>
</body>
</html>
