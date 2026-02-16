<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);
    
    if ($stmt->execute()) 
        $status = "success";
    } else {
        $status = "error";
    }

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($status) && $status == "success"): ?>
            <div class="success-box">
                <h2>Account Created!</h2>
                <p>Welcome to the team. You can now log in to book your flights.</p>
                <a href="login.php" class="btn">Go to Login</a>
            </div>
        <?php else: ?>
            <form method="post">
                <h2>Register</h2>
                <?php if(isset($status) && $status == "error") echo "<p style='color:red;'>User already exists!</p>"; ?>
                <input type="text" name="username" placeholder="Choose Username" required>
                <input type="password" name="password" placeholder="Choose Password" required>
                <button type="submit">Sign Up</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>