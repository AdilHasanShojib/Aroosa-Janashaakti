<?php
session_start();
include '../config.php';

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_blog.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM blogs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: manage_blog.php");
    exit();
}

$blog = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    // Handle file upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES['image']['name'];
        $target_dir = "../contents/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        $image = $blog['image'];
    }

    $sql = "UPDATE blogs SET title=?, content=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $image, $id);

    if ($stmt->execute()) {
        header("Location: manage_blog.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-container">
    <h2>Edit Blog Post</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
        <input type="file" name="image"> <br> <br>
        <button type="submit">Update Blog</button>
    </form>
</div>

</body>
</html>
