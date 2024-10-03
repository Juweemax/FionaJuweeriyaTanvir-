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
$salaryID = $_POST['salaryID'];
$salaryAmount = $_POST['salaryAmount'];
$date = $_POST['date'];
$currency = $_POST['currency'];
$staffID = $_POST['staffID'];
$departmentID = $_POST['departmentID'];
$performanceID = $_POST['performanceID'];

// Prepare SQL statement to insert data into Salary table
$sql = "INSERT INTO Salary (SalaryID, SalaryAmount, Date, Currency, StaffID, DepartmentID, PerformanceID) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsssss", $salaryID, $salaryAmount, $date, $currency, $staffID, $departmentID, $performanceID);

// Execute the statement
if ($stmt->execute()) {
    echo "Salary record added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
