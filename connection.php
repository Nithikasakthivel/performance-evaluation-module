<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = " ";
$dbname = "rithu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Example prepared statement to fetch data from the table index_db
$stmt = $conn->prepare("SELECT id, name, value FROM emp");
$stmt->execute();
$stmt->bind_result($id, $name, $value);

while ($stmt->fetch()) {
    echo "id: $id - Name: $name - Value: $value<br>";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
