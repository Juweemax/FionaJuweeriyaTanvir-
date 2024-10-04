<?php
session_start(); // Start session

// Database connection details
$servername = "localhost";
$db_username = "root";  // Your database username
$db_password = "";      // Your database password
$dbname = "ifsb_db";    // Your database name

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare user data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username exists
$checkUserSql = "SELECT * FROM users WHERE Username = ?";
$stmtCheck = $conn->prepare($checkUserSql);
$stmtCheck->bind_param("s", $username);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    // Username exists, fetch user data
    $user = $resultCheck->fetch_assoc();

    // Verify the password
    if ($password === $user['Password']) { // Direct comparison (assumes password is stored in plain text, which is not recommended)
        // Check if the user is HR staff
        if ($user['Role'] === 'HR staff') {
            $_SESSION['username'] = $username; // Store username in session
            header("Location: switchboard.php"); // Redirect to the switchboard
            exit();
        } else {
            echo "Access denied. You are not authorized to access this area.";
        }
    } else {
        echo "Invalid password. Please try again.";
    }
} else {
    echo "User does not exist.";
}

// Close connections
$stmtCheck->close();
$conn->close();
?>
