<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aroosa Janashakti | Home</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .search-box {
            text-align: center;
            margin: 20px 0;
        }

        .search-box input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-box button {
            padding: 10px 15px;
            background: #ffcc00;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

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
    <header>
        <div style="width: 100%; height: 1vh; background-color: #F68B1F;"></div>
        <div class="logo-title"><h1>AROOSA JANASHAKTI</h1></div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href=""><i class="fas fa-shopping-cart"></i> Software Shop</a>
            <a href="blog.php"><i class="fas fa-newspaper"></i> Blog</a>
            <a href="admin/admin_login.php" class="logout"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>
    </header>
    
    <section id="software">
        <h2>Available Software Products</h2>
        <div class="search-box">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Search Software..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>
        <div class="software-container">
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT * FROM software_products WHERE name LIKE ? ORDER BY created_at DESC";
            $stmt = $conn->prepare($sql);
            $searchTerm = "%" . $search . "%";
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="software-item">
                            <h3>' . htmlspecialchars($row["name"]) . '</h3>
                            <img src="contents/' . htmlspecialchars($row["image"]) . '" alt="Software Image" style="width: 150px; height: 150px; object-fit: cover;">
                            <p>' . htmlspecialchars($row["description"]) . '</p>
                            <p>Price: $' . htmlspecialchars($row["price"]) . '</p>
                            <a href="checkout.php?id=' . $row["id"] . '" class="buy-btn">Buy Now</a>
                          </div>';
                }
            } else {
                echo "<p>No software found.</p>";
            }
            ?>
        </div>
    </section>

    <footer>
        <h1>Aroosa Janashakti Ltd.</h1>
        <p>Level 3, Plot Kha 201/1, 203, 205/3,
           Bir Uttam Rafiqul Islam Ave, Dhaka 1213 <br><br>
           Email: info@aroosajanashakti.com</p>
        <p>&copy; 2025 Aroosa Janashakti. All rights reserved.</p>
    </footer>
</body>
</html>
