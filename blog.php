<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroosa Janashakti | Home</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link external CSS -->
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
        <a href=""><i class="fas fa-newspaper"></i> Blog</a>
        <a href="admin/admin_login.php" class="logout"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>

    </header>


    <!-- Blog Section -->
    <section id="blog">
        <h2>All Blog Posts</h2>
        <div class="blog-container">
            <?php
            $sql = "SELECT * FROM blogs ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="blog-post">
                            <h3>' . htmlspecialchars($row["title"]) . '</h3>
                            <img src="contents/' . htmlspecialchars($row["image"]) . '" alt="Blog Image">
                            <p>' . substr(htmlspecialchars($row["content"]), 0, 100) . '...</p>
                            <a href="blog_post.php?id=' . $row["id"] . '" class="read-more">Read More</a>
                          </div>';
                }
            } else {
                echo "<p>No blog posts available.</p>";
            }
            ?>
        </div>
    </section>

    
</body>
</html>
