<?php
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "performance"; // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch values from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare SQL query to check if the username and password exist in the database
$sql = "SELECT * FROM index_db WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // If a row is found, the login is successful
    session_start(); // Start the session
    $_SESSION['username'] = $username; // Store username in session variable
    header("Location: dashboard.html"); // Redirect to dashboard
} else {
    // If no row is found, the login fails
    echo "Invalid username or password";
}

$conn->close();
?>
