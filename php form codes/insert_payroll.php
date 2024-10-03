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
$payrollID = $_POST['payrollID'];
$payPeriod = $_POST['payPeriod'];
$incomeTax = $_POST['incomeTax'];
$allowance = $_POST['allowance'];
$deductions = $_POST['deductions'];
$overtimeHours = $_POST['overtimeHours'];
$staffID = $_POST['staffID'];
$salaryID = $_POST['salaryID'];
$performanceID = $_POST['performanceID'];

// Prepare SQL statement to insert data into Payroll table
$sql = "INSERT INTO Payroll (PayrollID, PayPeriod, IncomeTax, Allowance, Deductions, OvertimeHours, StaffID, SalaryID, PerformanceID) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssddddsss", $payrollID, $payPeriod, $incomeTax, $allowance, $deductions, $overtimeHours, $staffID, $salaryID, $performanceID);

// Execute the statement
if ($stmt->execute()) {
    echo "Payroll record added successfully!";
} else {
    echo "Error: " . $stmt->error; // More detailed error reporting
}

// Close connection
$stmt->close();
$conn->close();
?>

