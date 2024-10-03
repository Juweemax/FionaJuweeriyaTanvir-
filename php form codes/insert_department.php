<?php
// Database connection
$host = 'localhost';
$dbname = 'ifsb_db'; // Your database name
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentID = $_POST['departmentID']; // Now VARCHAR(4)
    $departmentName = $_POST['departmentName']; // Can be NULL
    $departmentLocation = $_POST['departmentLocation'];
    $noOfEmp = $_POST['noOfEmp'];
    $staffID = $_POST['staffID']; // Now VARCHAR(5)

    // Insert data into the Department table, handling NULL for DepartmentName
    $sql = "INSERT INTO Department (DepartmentID, DepartmentName, DepartmentLocation, NoOfEmp, StaffID) 
            VALUES ('$departmentID', 
                    " . (empty($departmentName) ? "NULL" : "'$departmentName'") . ", 
                    '$departmentLocation', 
                    '$noOfEmp', 
                    '$staffID')";

    if ($conn->query($sql) === TRUE) {
        echo "New department added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

