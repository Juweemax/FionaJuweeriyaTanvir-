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
    $staffID = $_POST['staffID']; // VARCHAR(5)
    $staffSalary = $_POST['staffSalary']; // DECIMAL(15, 2), cannot be NULL
    $firstName = $_POST['firstName']; // VARCHAR(50), cannot be NULL
    $lastName = $_POST['lastName']; // VARCHAR(50), cannot be NULL
    $ic = $_POST['ic']; // VARCHAR(20), cannot be NULL
    $address = $_POST['address']; // VARCHAR(255), cannot be NULL
    $phoneNumber = $_POST['phoneNumber']; // VARCHAR(20), cannot be NULL
    $age = $_POST['age']; // INT, optional
    $gender = $_POST['gender']; // VARCHAR(10), optional
    $departmentID = $_POST['departmentID']; // VARCHAR(4), cannot be NULL
    $insurance = $_POST['insurance']; // VARCHAR(100), cannot be NULL
    $dob = $_POST['dob']; // DATE, cannot be NULL

    // Insert data into the Staff table
    $sql = "INSERT INTO Staff (StaffID, StaffSalary, FirstName, LastName, IC, Address, PhoneNumber, Age, Gender, DepartmentID, Insurance, DOB) 
            VALUES ('$staffID', 
                    '$staffSalary', 
                    '$firstName', 
                    '$lastName', 
                    '$ic', 
                    '$address', 
                    '$phoneNumber', 
                    " . (empty($age) ? "NULL" : "'$age'") . ", 
                    " . (empty($gender) ? "NULL" : "'$gender'") . ", 
                    '$departmentID', 
                    '$insurance', 
                    '$dob')";

    if ($conn->query($sql) === TRUE) {
        echo "New staff member added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

