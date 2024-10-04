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

// Initialize confirmation message
$confirmationMessage = '';

// Check for updates
if (isset($_POST['update'])) {
    $staffID = $_POST['staffID'];
    $salaryAmount = $_POST['salaryAmount'];
    $allowance = $_POST['allowance'];
    $deductions = $_POST['deductions'];
    $incomeTax = $_POST['incomeTax'];
    
    // Update Salary table
    $updateSalarySql = "UPDATE Salary SET SalaryAmount = ? WHERE StaffID = ?";
    $stmt = $conn->prepare($updateSalarySql);
    $stmt->bind_param("ds", $salaryAmount, $staffID);
    
    if ($stmt->execute()) {
        $confirmationMessage = "Salary record updated successfully.";
    } else {
        $confirmationMessage = "Error updating salary record: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch the report data
$sql = "SELECT 
            s.StaffID,
            s.FirstName,
            s.LastName,
            sal.SalaryAmount,
            p.Allowance,
            p.Deductions,
            p.IncomeTax,
            ((sal.SalaryAmount + p.Allowance) - p.Deductions - p.IncomeTax) AS TOTALSALARY
        FROM 
            Staff s
        JOIN 
            Salary sal ON s.StaffID = sal.StaffID
        JOIN 
            Payroll p ON s.StaffID = p.StaffID
        WHERE 
            sal.SalaryID = p.SalaryID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Salary Report</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f0f9f0; /* Light green background */
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
        .confirmation {
            color: #4CAF50;
            font-weight: bold;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h2>Total Salary Report Record</h2>

    <?php if ($confirmationMessage): ?>
        <div class="confirmation"><?php echo htmlspecialchars($confirmationMessage); ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>StaffID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Salary Amount</th>
                <th>Allowance</th>
                <th>Deductions</th>
                <th>Income Tax</th>
                <th>Total Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <form method="POST" style="display:inline;">
                    <td><?php echo $row['StaffID']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td>
                        <input type="number" step="0.01" name="salaryAmount" value="<?php echo $row['SalaryAmount']; ?>" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="allowance" value="<?php echo $row['Allowance']; ?>" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="deductions" value="<?php echo $row['Deductions']; ?>" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="incomeTax" value="<?php echo $row['IncomeTax']; ?>" required>
                    </td>
                    <td>
                        <?php echo number_format($row['TOTALSALARY'], 2); ?>
                    </td>
                    <td>
                        <input type="hidden" name="staffID" value="<?php echo $row['StaffID']; ?>">
                        <button type="submit" name="update" style="background-color: #4CAF50; color: white; border: none; padding: 5px 10px; cursor: pointer;">Save</button>
                    </td>
                </form>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="your_switchboard_file.php" style="display: inline-block; margin: 20px 0; padding: 10px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none;">Back to Switchboard</a>
</body>
</html>

<?php
$conn->close();
?>
