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
$healthID = $_POST['healthID'];
$medicalRecords = $_POST['medicalRecords'];
$staffID = $_POST['staffID'];

// Prepare SQL statement to insert data into Health table
$sql = "INSERT INTO Health (healthID, medicalRecords, staffID) VALUES (?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $healthID, $medicalRecords, $staffID);

// Execute the statement
if ($stmt->execute()) {
    echo "Health record added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
