<?php
session_start();
//include '../config.php';

$host = "localhost";  
$user = "root";       
$pass = "";          
$dbname = "aroosa_janashakti";


$conn = new mysqli($host, $user, $pass, $dbname);


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

    // file upload
    $image = $_FILES['image']['name'];
    $target_dir = "../contents/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    


   
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        $sql = "INSERT INTO software_products (name, description, price, file, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdss", $name, $description, $price, $file, $image);


        if ($stmt->execute()) {
             header("Location: manage_software.php");
             exit();
        } else {
             echo "Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }

}

?>
