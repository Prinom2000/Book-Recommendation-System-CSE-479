<?php
header('Access-Control-Allow-Origin: http://localhost:5173');

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cse479';

// Connect to MySQL database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from database
$sql = "SELECT * FROM popular_books";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch data and encode as JSON
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    // No rows found
    echo json_encode(array('message' => 'No records found'));
}

// Close database connection
$conn->close();

?>
