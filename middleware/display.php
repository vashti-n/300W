
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


// DB connection settings — change these if needed
$host ='172.31.23.222';
$dbname = 'instacart';
$username = 'root';
$password = ''; // use your actual DB password if you set one

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query data
$sql = "SELECT * FROM quality_reports";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quality Report Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Instacart Quality Reports</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Report</th>
            <th>Date</th>
        </tr>

        <?php
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['item']}</td>
                        <td>{$row['report']}</td>
                        <td>{$row['date']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>

