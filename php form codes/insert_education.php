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
$educationID = $_POST['educationID'];
$degree = $_POST['degree'];
$university = $_POST['university'];
$graduationCertificate = $_POST['graduationCertificate'];
$staffID = $_POST['staffID'];

// Prepare SQL statement to insert data into Education table
$sql = "INSERT INTO Education (educationID, degree, university, graduationCertificate, staffID) VALUES (?, ?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $educationID, $degree, $university, $graduationCertificate, $staffID);

// Execute the statement
if ($stmt->execute()) {
    echo "Education record added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
