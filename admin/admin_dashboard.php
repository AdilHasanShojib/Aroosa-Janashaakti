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

        body{
            background: white;

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


    .typing-container {
    
    font-size: 50px;
    font-weight: bold;
    color: black;
    font-family: Arial, sans-serif;
    border-right: 3px solid white; /* Blinking cursor effect */
    white-space: nowrap;
    overflow: hidden;
    width: 0;
    animation: typing 3s steps(15, end) forwards, blink 0.7s infinite;
  }

  @keyframes typing {
    from {
      width: 0%;
    }
    to {
      width: 100%; /* Adjust width according to text length */
    }
  }

  @keyframes blink {
    50% {
      border-color: transparent;
    }
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
       
        <img src="../contents/admim.jpg" alt="Image" height="300px" width="auto">

         <h2 class="typing-container">Welcome, Admin!</h2>
    </div>

</body>
</html>
