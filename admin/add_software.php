<?php
session_start();
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




if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $file = $_POST['file_link'];

    $sql = "INSERT INTO software_products (name, description, price, file) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssds", $name, $description, $price, $file);

    if ($stmt->execute()) {
        header("Location: manage_software.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
