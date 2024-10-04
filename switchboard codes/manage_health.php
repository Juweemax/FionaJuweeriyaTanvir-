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

// Check for deletion
if (isset($_POST['delete'])) {
    $healthID = $_POST['healthID'];
    $deleteSql = "DELETE FROM Health WHERE HealthID = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $healthID);
    if ($stmt->execute()) {
        $confirmationMessage = "Record deleted successfully.";
    } else {
        $confirmationMessage = "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch health records
$sql = "SELECT * FROM Health";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Health Records</title>
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
    <h2>Manage Health Records</h2>

    <?php if ($confirmationMessage): ?>
        <div class="confirmation"><?php echo htmlspecialchars($confirmationMessage); ?></div>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>HealthID</th>
                <th>Medical Records</th>
                <th>StaffID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['healthID']; ?></td>
                <td><?php echo htmlspecialchars($row['medicalRecords']); ?></td>
                <td><?php echo $row['staffID']; ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="healthID" value="<?php echo $row['healthID']; ?>">
                        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this record?');" style="background-color: transparent; border: none; color: #4CAF50;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="health_entry_form.html" style="display: inline-block; margin: 20px 0; padding: 10px; background-color: #4CAF50; color: white; text-align: center; text-decoration: none;">Add Record</a>
</body>
</html>

<?php
$conn->close();
?>
