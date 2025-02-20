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
         echo "Software Update successfully!";
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        nav {
            background: #333;
            padding: 3px 6px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            gap: 20px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        nav a:hover {
            color: #ffcc00;
        }

        /* Logout Positioning */
        .logout {
            position: absolute;
            right: 20px;
        }

    </style>
</head>
<body>
    <header>
        <div style="width: 100%; height: 1vh; background-color: #F68B1F;"></div>
    <h1>Edit Blog Post</h1>
    <nav>
        <a href="admin_dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="manage_software.php" ><i class="fas fa-cogs"></i> Manage Software</a>
        <a href="manage_blog.php"><i class="fas fa-newspaper"></i> Manage Blog</a>
        <a href="admin_logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>
</header>

<div class="admin-container">
    
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
        <input type="file" name="image"> <br> <br>
        <button type="submit" class="buy-btn">Update Blog</button>
    </form>
</div>

</body>
</html>
