<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/php-error.log'); // Update to a valid path on your server
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cse479";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

$query = isset($_GET['query']) ? $_GET['query'] : '';

if ($query !== '') {
    $sql = "SELECT `recommended_book_title`, `recommended_book_author`, `recommended_url` FROM recommended_books WHERE `input_book_title` LIKE ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $param = "%{$query}%";
        $stmt->bind_param("s", $param);
        $stmt->execute();
        $result = $stmt->get_result();

        $recommendations = [];
        while ($row = $result->fetch_assoc()) {
            $recommendations[] = $row;
        }

        $stmt->close();
        echo json_encode($recommendations);
    } else {
        error_log("Failed to prepare statement");
        echo json_encode(["error" => "Failed to prepare statement"]);
    }
} else {
    echo json_encode([]);
}

$conn->close();
?>
