<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Switchboard</title>
    <style>
        /* General page styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .switchboard-container {
            background-color: #e6ffe6; /* Light green background */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            color: #006600;
            font-size: 36px;
            margin-bottom: 20px;
        }

        h2 {
            color: #006600;
            font-size: 28px;
            margin-bottom: 30px;
        }

        /* Grid for two buttons per row */
        .button-row {
            display: flex;
            justify-content: center;
            gap: 30px; /* Spacing between buttons */
            margin-bottom: 30px;
        }

        /* Styling for big square buttons */
        .switchboard-btn {
            width: 200px;
            height: 200px;
            background-color: #339933; /* Green button */
            color: white;
            border: none;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        /* Icon styles for buttons */
        .switchboard-btn i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        /* Title inside the button */
        .switchboard-btn span {
            font-size: 18px;
            text-align: center;
        }

        .switchboard-btn:hover {
            background-color: #2d862d; /* Darker green on hover */
        }

        /* Center last button alone */
        .centered-button {
            display: flex;
            justify-content: center;
        }

        /* Styling for logout button */
        .logout-btn {
            display: block;
            margin-top: 40px;
            padding: 10px 20px;
            background-color: #cc0000; /* Red for logout */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .logout-btn:hover {
            background-color: #990000; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="switchboard-container">
        <h1>Impact Factor Sdn. Bhd.</h1>
        <h2>HR Switchboard</h2>

        <!-- First Row of Buttons -->
        <div class="button-row">
            <a href="manage_staff.php" class="switchboard-btn">
                <i class="fas fa-users"></i> <!-- Icon for managing staff -->
                <span>Manage Staff Record</span>
            </a>
            <a href="manage_payroll.php" class="switchboard-btn">
                <i class="fas fa-dollar-sign"></i> <!-- Icon for payroll -->
                <span>Manage Payroll Record</span>
            </a>
        </div>

        <!-- Second Row of Buttons -->
        <div class="button-row">
            <a href="manage_salary.php" class="switchboard-btn">
                <i class="fas fa-wallet"></i> <!-- Icon for salary management -->
                <span>Manage Salary Record</span>
            </a>
            <a href="manage_health.php" class="switchboard-btn">
                <i class="fas fa-heartbeat"></i> <!-- Icon for health records -->
                <span>Manage Health Record</span>
            </a>
        </div>

        <!-- Last button centered -->
        <div class="centered-button">
            <a href="generate_reports.php" class="switchboard-btn">
                <i class="fas fa-file-alt"></i> <!-- Icon for reports -->
                <span>Generate & View Reports</span>
            </a>
        </div>

        <!-- Logout button at the bottom -->
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

    <!-- Add FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
