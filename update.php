<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Simple validation (you can add more complex validation as needed)
    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Assuming you have a database connection, update the password
    // Replace the database connection details with your own
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "performance";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to update password
    $sql = "UPDATE index_db SET password='$password' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Password updated successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Unsupported HTTP method.";
}
?>
