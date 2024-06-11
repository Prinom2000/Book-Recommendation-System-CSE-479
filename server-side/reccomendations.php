<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:5173');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cse479";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query !== '') {
    $sql = "SELECT DISTINCT `recommended_book_title` FROM books WHERE `input_book_title` LIKE ?";
    $stmt = $conn->prepare($sql);
    $param = "%{$query}%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['recommended_book_title'];
    }

    $stmt->close();
    echo json_encode($suggestions);
} else {
    echo json_encode([]);
}

$conn->close();
?>
