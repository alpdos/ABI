<?php
session_start(); // Start session to store user info
require_once "config.php";

$message = "";

// Handle local login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['local_login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Placeholder local login logic
    if ($username === "admin" && $password === "admin123") {
        $_SESSION['user_name'] = $username; // store in session
        header("Location: dashboard.php");   // redirect to dashboard
        exit;
    } else {
        $message = "Invalid username/password.";
    }
}

// Google OAuth URL
$google_auth_url = "https://accounts.google.com/o/oauth2/v2/auth?"
    . "client_id=" . CLIENT_ID
    . "&redirect_uri=" . urlencode(REDIRECT_URI)
    . "&response_type=code"
    . "&scope=openid%20email%20profile"
    . "&access_type=offline"
    . "&prompt=consent";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 40px; }
        .login-box {
            background: white; width: 320px; margin: auto; padding: 25px;
            border-radius: 10px; border: 1px solid #ccc;
        }
        input { width: 100%; padding: 10px; margin: 8px 0; }
        button { width: 100%; padding: 10px; cursor: pointer; }
        .msg { margin-top: 10px; font-weight: bold; color: #c00; }
        .google-btn {
            background: #4285F4; color: white; border: none; margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Login</h2>

    <!-- Local login form -->
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="local_login">Login</button>
    </form>

    <!-- Message -->
    <?php if ($message): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <hr>
    <!-- Google Sign-In button -->
    <a href="<?= $google_auth_url ?>">
        <button class="google-btn">Sign in with Google</button>
    </a>
</div>

</body>
</html>
