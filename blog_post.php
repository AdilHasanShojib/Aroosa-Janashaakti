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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>

      



        .logo-title{
          font-family: 'Playfair Display', serif;
            font-size: 17px;
            margin: 0;
            color: white;
            justify-content: center;
            word-spacing: 15px;
        }

        
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

    <!-- Navigation Bar -->
    <header>
        <div style="width: 100%; height: 1vh; background-color: #F68B1F;"></div>
          
        <div class="logo-title"><h1 >AROOSA JANASHAKTI</h1></div>
        
     

        <nav>

        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="software.php"><i class="fas fa-shopping-cart"></i> Software Shop</a>
        <a href="blog.php"><i class="fas fa-newspaper"></i> Blog</a>
        <a href="admin/admin_login.php" class="logout"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>
</header>

<div class="single-blog" style="text-align: center; max-width: 800px; margin: auto;">
    <h3 style="font-size: 28px; font-weight: bold; margin-top: 50px"><?php echo htmlspecialchars($blog["title"]); ?></h3>
    <img src="contents/<?php echo htmlspecialchars($blog["image"]); ?>" height="300px" width="auto" alt="Blog Image" style="display: block; margin: 20px auto;">
    <p style="font-size: 20px; line-height: 1.6;  text-align: left"><?php echo htmlspecialchars($blog["content"]); ?></p>
</div>





</body>
</html>
