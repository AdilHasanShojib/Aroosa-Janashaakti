<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM blogs WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

$blog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
   <h1>Aroosa Janashakti</h1>
        <nav>

            <a href="index.php">Home</a>
            <a href="#software">Software Shop</a>
            <a href="#blog">Blog</a>
            <a href="admin/admin_login.php">Admin</a>
        </nav>
</header>

<div class="single-blog">
     <h3><?php echo htmlspecialchars($blog["title"]); ?></h3>
    <img src="contents/<?php echo htmlspecialchars($blog["image"]); ?>" height="300px" width="auto" alt="Blog Image"> <br> <br>
    <p><?php echo htmlspecialchars($blog["content"]); ?></p>
</div>

<a href="index.php">Back to Home</a>

</body>
</html>
