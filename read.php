<?php
include 'config.php';

// Check if ID parameter is passed
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    header("Location: request.php");
    exit();
}

$id = $_GET['id'];

// Fetch guard request details
$sql = "SELECT * FROM guard_requests WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $eventType = $row['event_type'];
    $numGuards = $row['num_guards'];
    $duration = $row['duration'];
    $price = $row['price'];
} else {
    header("Location: request.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guard Request Details - Security Company</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <img src="logo.png" alt="Company Logo">
        <h1>Security Company</h1>
    </header>
    <nav>
        <ul>
            <li><a href="request.php">Home</a></li>
            <li><a href="create.php">New Request</a></li>
        </ul>
    </nav>
    <div class="content">
        <h2>Guard Request Details</h2>
        <p><strong>Event Type:</strong> <?php echo $eventType; ?></p>
        <p><strong>Number of Guards:</strong> <?php echo $numGuards; ?></p>
        <p><strong>Duration (hours):</strong> <?php echo $duration; ?></p>
        <p><strong>Price ($):</strong> <?php echo $price; ?></p>
        <a href="request.php">Back to List</a>
    </div>
</body>
</html>
