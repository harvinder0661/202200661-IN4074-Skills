<?php
include 'config.php';

// Fetch all guard requests
$sql = "SELECT * FROM guard_requests";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guard Requests - Security Company</title>
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
        <h2>Guard Requests</h2>
        <table>
            <tr>
                <th>Event Type</th>
                <th>Number of Guards</th>
                <th>Duration (hours)</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['event_type']; ?></td>
                <td><?php echo $row['num_guards']; ?></td>
                <td><?php echo $row['duration']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td>
                    <a href="read.php?id=<?php echo $row['id']; ?>">View</a>
                    <a href="update.php?id=<?php echo $row['id']; ?>">Update</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
