<?php
//include '../config.php';
$host = "localhost";  // Change if using an external database
$user = "root";       // Default user for local development
$pass = "";           // Default password (leave blank for XAMPP)
$dbname = "aroosa_janashakti";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hashed_password = password_hash("6284", PASSWORD_DEFAULT);

$sql = "INSERT INTO admin (username, password) VALUES ('admin', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Admin user created successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
