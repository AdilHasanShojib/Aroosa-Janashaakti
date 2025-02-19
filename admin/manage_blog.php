<?php
session_start();
include '../config.php';

if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

// Handle blog post deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_blog.php");
        exit();
    }
}

// Fetch all blog posts
$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <h1>Manage Blog</h1>
    <nav>
        <a href="admin_dashboard.php">Home</a>
        <a href="admin_logout.php">Logout</a>
    </nav>
</header>

<div class="admin-container">
    <h2>Add New Blog Post</h2>
    <form action="add_blog.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Blog Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <input type="file" name="image" required> <br>
        <button type="submit">Add Blog</button>
    </form>

    <h2>Blog Posts</h2>
    <table>
        <tr>
            <th>Title</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><img src="../contents/<?php echo $row['image']; ?>" width="100"></td>
            <td>
                <a href="edit_blog.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="manage_blog.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
