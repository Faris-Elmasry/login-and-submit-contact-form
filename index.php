<?php
 require_once 'classes/User.php';
$error_message = "";
$success_message = "";

// Check if user just logged out
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $success_message = "Logged out successfully! All sessions and cookies have been deleted.";
}

// Check if user tried to access protected page without login
if (isset($_GET['error']) && $_GET['error'] === 'notloggedin') {
    $error_message = "Please login to access that page.";
}

// Handle login form submission (POST)
if (isset($_POST['username']) && isset($_POST['password'])) {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $user = new User($username , $password);
    if ($user->authenticate($username, $password)) {
        header("Location: /pages/contact.php");
        exit();
    }
    else {
        $error_message = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>login</title>
</head>
<body>
    

 
<div class="login">
    <div class="container">
          <button> <a href="pages/showdata.php">track the cookies and sessions data</a> </button>
            <form action=""  method="post">
            <h1>Welcome to Our Website</h1>
            <?php if ($error_message): ?>
                <div class="message error-message"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            
            <?php if ($success_message): ?>
                <div class="message success-message"><?php echo htmlspecialchars($success_message); ?></div>
            <?php endif; ?>
            
            <div class="login-header">
                <h2>Login</h2>
            </div>
            <div class="login-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="user123" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="pass123" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</div>
        </div>
    </form>
</div>

<script src="assets/main.js"></script>
 
</body>
</html>