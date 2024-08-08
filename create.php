<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $eventType = $_POST['eventType'];
    $numGuards = $_POST['numGuards'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    // Insert into database
    $sql = "INSERT INTO guard_requests (event_type, num_guards, duration, price) VALUES ('$eventType', '$numGuards', '$duration', '$price')";
    if ($conn->query($sql) === TRUE) {
        header("Location: request.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Guard Request - Security Company</title>
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
        <h2>New Guard Request</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="eventType">Event Type:</label><br>
            <input type="text" id="eventType" name="eventType" required><br>
            <label for="numGuards">Number of Guards:</label><br>
            <input type="number" id="numGuards" name="numGuards" required><br>
            <label for="duration">Duration (hours):</label><br>
            <input type="number" id="duration" name="duration" required><br>
            <label for="price">Price ($):</label><br>
            <input type="number" id="price" name="price" readonly><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <script>
        // Calculate price based on number of guards and duration
        document.getElementById('numGuards').addEventListener('input', function() {
            const numGuards = parseInt(this.value);
            const duration = parseInt(document.getElementById('duration').value);
            if (!isNaN(numGuards) && !isNaN(duration)) {
                document.getElementById('price').value = numGuards * duration * 100; // Assuming $100 per guard per hour
            }
        });

        document.getElementById('duration').addEventListener('input', function() {
            const numGuards = parseInt(document.getElementById('numGuards').value);
            const duration = parseInt(this.value);
            if (!isNaN(numGuards) && !isNaN(duration)) {
                document.getElementById('price').value = numGuards * duration * 100; // Assuming $100 per guard per hour
            }
        });
    </script>
</body>
</html>
