<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destination = $_POST['destination'];
    $date = $_POST['travel_date'];
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, destination, travel_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $destination, $date);
    
    if ($stmt->execute()) {
        $msg = "Flight to " . htmlspecialchars($destination) . " booked!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a> | <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h2>Book a Flight</h2>
        <?php if(isset($msg)) echo "<p class='success'>$msg</p>"; ?>
        <form method="post">
            <input type="text" name="destination" placeholder="Destination (e.g. London)" required>
            <input type="date" name="travel_date" required>
            <button type="submit">Reserve Ticket</button>
        </form>
    </div>
</body>
</html>
