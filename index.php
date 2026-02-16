<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Asenvzhuh - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <div class="logo">Asenvzhuh</div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php if(isset($_SESSION['user_id'])): ?>
                <li><a href="booking.php">Book a Flight</a></li>
                <li><a href="logout.php">Logout (<?php echo $_SESSION['username']; ?>)</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="hero">
        <h1>Welcome to Asenvzhuh</h1>
        <p>Book your next adventure with just a few clicks.</p>
        <?php if(!isset($_SESSION['user_id'])): ?>
            <a href="register.php" class="btn">Get Started</a>
        <?php else: ?>
            <a href="booking.php" class="btn">Book Now</a>
        <?php endif; ?>
    </header>

    <section class="features">
        <div class="feature">
            <h3>Secure Booking</h3>
            <p>Using prepared statements for your safety.</p>
        </div>
        <div class="feature">
            <h3>Fast Results</h3>
            <p>Real-time flight data processing.</p>
        </div>
    </section>

</body>
</html>