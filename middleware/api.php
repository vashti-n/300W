<?php
header('Content-Type: application/json');

// Database credentials
$host = '172.31.23.222'; // ← use your DB server’s PRIVATE IP
$dbname = 'instacart';
$username = 'root';
$password = ''; // Or your actual password if you created one

// Connect to DB
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

// Get item from query string (e.g. ?item=Lettuce)
$item = isset($_GET['item']) ? $conn->real_escape_string($_GET['item']) : '';

// Run query
if ($item !== '') {
    $sql = "SELECT * FROM quality_reports WHERE item LIKE '%$item%'";
} else {
    $sql = "SELECT * FROM quality_reports";
}

$result = $conn->query($sql);

// Format and return JSON
$data = ["items" => []];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data["items"][] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>
<?php
$data = [
  "status" => "success",
  "items" => [
    ["item" => "Lettuce", "report" => "Wilted"],
    ["item" => "Eggs", "report" => "Cracked"]
  ]
];

header('Content-Type: application/json');
echo json_encode($data);
?>
