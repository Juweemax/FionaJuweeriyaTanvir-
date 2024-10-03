<?php
// Database connection
$host = 'localhost';
$dbname = 'ifsb_db'; // Replace with your actual database name
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainingID = $_POST['trainingID'];
    $duration = $_POST['duration']; // in weeks
    $venue = $_POST['venue'];
    $trainingRate = $_POST['trainingRate'];
    $date = $_POST['date'];
    $staffID = $_POST['staffID']; // Optional

    // Insert data into the Training table, handling NULL for staffID
    $sql = "INSERT INTO Training (trainingID, duration, venue, trainingRate, date, staffID) 
            VALUES ('$trainingID', 
                    '$duration', 
                    '$venue', 
                    '$trainingRate', 
                    '$date', 
                    " . (empty($staffID) ? "NULL" : "'$staffID'") . ")";

    if ($conn->query($sql) === TRUE) {
        echo "New training session added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
