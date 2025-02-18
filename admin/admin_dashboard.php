<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <div style="width: 100%; height: 1vh; background-color: #F68B1F;"></div>
        <h1>Admin Panel</h1>
        <nav>
            <a href="manage_software.php">Manage Software</a>
            <a href="manage_blog.php">Manage Blog</a>
            <a href="admin_logout.php">Logout</a>
        </nav>
    </header>

    <div class="admin-container">
       
        <img src="../contents/admin.png" alt="Image" height="300px" width="auto">
         <h2>Welcome, Admin!</h2>
    </div>

</body>
</html>
