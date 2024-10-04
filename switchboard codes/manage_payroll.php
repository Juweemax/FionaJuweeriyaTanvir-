<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ifsb_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion if the delete request is made
if (isset($_GET['delete_id'])) {
    $payrollID = $_GET['delete_id'];

    // Delete record
    $delete_sql = "DELETE FROM Payroll WHERE PayrollID = '$payrollID'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Record deleted successfully.'); window.location.href='manage_payroll.php';</script>";
    } else {
        echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
    }
}

// Fetch payroll records
$sql = "SELECT * FROM Payroll";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payroll Records</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f4f4f4; /* Light background */
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #4CAF50; /* Green heading */
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50; /* Green header */
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1; /* Light grey on hover */
        }
        a {
            color: #4CAF50; /* Green links */
            text-decoration: none;
        }
        .button {
            background-color: #4CAF50; /* Green button */
            color: white;
            padding: 10px 15px;
            text-align: center;
            display: inline-block;
            margin: 20px auto;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>
    <h2>Manage Payroll Records</h2>
    <table>
        <thead>
            <tr>
                <th>PayrollID</th>
                <th>PayPeriod</th>
                <th>IncomeTax</th>
                <th>Allowance</th>
                <th>Deductions</th>
                <th>GrossPay</th>
                <th>NetPay</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['PayrollID']; ?></td>
                <td><?php echo $row['PayPeriod']; ?></td>
                <td><?php echo $row['IncomeTax']; ?></td>
                <td><?php echo $row['Allowance']; ?></td>
                <td><?php echo $row['Deductions']; ?></td>
                <td><?php echo $row['GrossPay']; ?></td>
                <td><?php echo $row['NetPay']; ?></td>
                <td>
                    <a href="manage_payroll.php?delete_id=<?php echo $row['PayrollID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <a href="payroll_entry_form.html" class="button">Add Record</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
