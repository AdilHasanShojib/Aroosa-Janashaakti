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
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <h1>Aroosa Janashakti</h1>
        <nav>

            <a href="#">Home</a>
            <a href="#software">Software Shop</a>
            <a href="#blog">Blog</a>
            <a href="admin/admin_login.php">Admin</a>
        </nav>
    </header>

    <!-- Software Shop Section -->
    <section id="software">
        <h2>Software Products</h2>
        <div class="software-container">
            <?php
            $sql = "SELECT * FROM software_products ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="software-item">
                            <h3>' . htmlspecialchars($row["name"]) . '</h3>
                            <p>' . htmlspecialchars($row["description"]) . '</p>
                            <p>Price: $' . htmlspecialchars($row["price"]) . '</p>
                            <a href="checkout.php?id=' . $row["id"] . '" class="buy-btn">Buy Now</a>
                          </div>';
                }
            } else {
                echo "<p>No software available.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog">
        <h2>Latest Blog Posts</h2>
        <div class="blog-container">
            <?php
            $sql = "SELECT * FROM blogs ORDER BY created_at DESC LIMIT 3";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="blog-post">
                            <h3>' . htmlspecialchars($row["title"]) . '</h3>
                            <img src="uploads/' . htmlspecialchars($row["image"]) . '" alt="Blog Image">
                            <p>' . substr(htmlspecialchars($row["content"]), 0, 100) . '...</p>
                            <a href="blog_detail.php?id=' . $row["id"] . '" class="read-more">Read More</a>
                          </div>';
                }
            } else {
                echo "<p>No blog posts available.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Aroosa Janashakti. All rights reserved.</p>
    </footer>

</body>
</html>
