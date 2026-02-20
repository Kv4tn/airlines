<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $del = $conn->prepare("DELETE FROM bookings WHERE id = ? AND user_id = ?");
    $del->bind_param("ii", $delete_id, $user_id);
    $del->execute();
    header("Location: profile.php"); 
}
$stmt = $conn->prepare("SELECT id, destination, travel_date FROM bookings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Trips - Asenvzhuh</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo">Asenvzhuh</div>
        <a href="index.php">Home</a> | <a href="booking.php">Book Flight</a>
    </nav>

    <div class="container" style="max-width: 700px;">
        <h2>Your Itinerary</h2>
        <table>
            <tr>
                <th>Destination</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['destination']); ?></td>
                <td><?php echo $row['travel_date']; ?></td>
                <td>
                    <a href="profile.php?delete_id=<?php echo $row['id']; ?>" 
                       class="btn-danger" 
                       onclick="return confirm('Cancel this flight?')">Cancel</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>