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
       <!-- Font Awesome CDN -->
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
        <h1>Admin Panel</h1>
        <nav>
            <a href=""><i class="fas fa-home"></i> Home</a>
        <a href="manage_software.php" ><i class="fas fa-cogs"></i> Manage Software</a>
        <a href="manage_blog.php"><i class="fas fa-newspaper"></i> Manage Blog</a>
        <a href="admin_logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </header>

    <div class="admin-container">
       
        <img src="../contents/admin.png" alt="Image" height="300px" width="auto">
         <h2 style="font-size: 50px;">Welcome, Admin!</h2>
    </div>

</body>
</html>
