<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    $sql = "SELECT * FROM guard_requests WHERE id='$id'";
    $result = $conn->query($sql);
    $request = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $eventType = $_POST['eventType'];
    $numGuards = $_POST['numGuards'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];

    $sql = "UPDATE guard_requests SET event_type='$eventType', num_guards='$numGuards', duration='$duration', price='$price' WHERE id='$id'";
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
    <title>Update Guard Request - Security Company</title>
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
        <h2>Update Guard Request</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="id" value="<?php echo $request['id']; ?>">
            <label for="eventType">Event Type:</label><br>
            <input type="text" id="eventType" name="eventType" value="<?php echo $request['event_type']; ?>" required><br>
            <label for="numGuards">Number of Guards:</label><br>
            <input type="number" id="numGuards" name="numGuards" value="<?php echo $request['num_guards']; ?>" required><br>
            <label for="duration">Duration (hours):</label><br>
            <input type="number" id="duration" name="duration" value="<?php echo $request['duration']; ?>" required><br>
            <label for="price">Price ($):</label><br>
            <input type="number" id="price" name="price" value="<?php echo $request['price']; ?>" readonly><br>
            <input type="submit" value="Update">
        </form>
    </div>
    <script>
        // Recalculate price based on number of guards and duration
        document.getElementById('numGuards').addEventListener('input', function() {
            const numGuards = parseInt(this.value);
            const duration = parseInt(document.getElementById('duration').value);
            if (!isNaN(numGuards) && !isNaN(duration)) {
                document.getElementById('price').value = numGuards * duration * 100;
            }
        });

        document.getElementById('duration').addEventListener('input', function() {
            const numGuards = parseInt(document.getElementById('numGuards').value);
            const duration = parseInt(this.value);
            if (!isNaN(numGuards) && !isNaN(duration)) {
                document.getElementById('price').value = numGuards * duration * 100;
            }
        });
    </script>
</body>
</html>
