<?php
session_start();
include '../config.php';

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "../contents/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO blogs (title, content, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $content, $image);

        if ($stmt->execute()) {
            header("Location: manage_blog.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "File upload failed!";
    }
}
?>
