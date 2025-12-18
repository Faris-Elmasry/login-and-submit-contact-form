<?php
 require_once '../classes/User.php';
$user = new User("user123", "pass123");
$userData = $user->getuser();
         $session_username = $userData['session'];
                $logged_in = $userData['logged_in'];
                $cookie_username = $userData['cookie_username'];
                $cookie_password = $userData['cookie_password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Show Data</title>
</head>
<body>
    <div class="contact">
        <div class="container" style="margin-top: 50px;">
            <h1>Session & Cookie Data</h1>
            
      
            <h2>Session Data:</h2>
            <p>Username: <?php echo htmlspecialchars($session_username); ?></p>
            <p>Logged In: <?php echo $logged_in; ?></p>
            
            <h2>Cookie Data:</h2>
            <p>Username: <?php echo htmlspecialchars($cookie_username); ?></p>
            <p>Password: <?php echo htmlspecialchars($cookie_password); ?></p>
            
            <br>
            <button><a href="../index.php">Back to Login</a></button>
            <button><a href="../pages/contact.php">Go to Contact</a></button>
        </div>
    </div>
</body>
</html>