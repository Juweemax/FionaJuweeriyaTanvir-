<?php
// Connection to MySQL database
$servername = "localhost"; // Change if needed
$username = "root";        // Change if needed
$password = "";            // Change if needed
$dbname = "ifsb_db";       // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$PerformanceID = $_POST['PerformanceID'];
$Rating = $_POST['Rating'];
$Date = $_POST['Date'];
$StaffID = $_POST['StaffID'];

// Prepare SQL statement to insert data into PerformanceRating table
$sql = "INSERT INTO PerformanceRating (PerformanceID, Rating, Date, StaffID) VALUES (?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("siss", $PerformanceID, $Rating, $Date, $StaffID);

// Execute the statement
if ($stmt->execute()) {
    echo "Performance rating added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
