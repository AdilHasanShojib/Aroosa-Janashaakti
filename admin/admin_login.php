<?php
session_start();
//include '../config.php';

$host = "localhost"; 
$user = "root";       
$pass = "";           
$dbname = "aroosa_janashakti";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin["password"])) {
            $_SESSION["admin_logged_in"] = true;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Admin not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <style >
        
  .error{
    color: red;
    font-weight: bold;
  }





    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if (isset($error)) echo "<p class='error' >$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
             <button type="submit" style="background-color: #25d366; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius:5px; cursor: pointer;">Login</button>  <br> <br>

            <button style="background-color: #007bff; padding: 10px 20px; width: 200px; font-size: 16px; border: none; border-radius:5px; cursor: pointer;">
    <a href="../index.php" style="color: white; text-decoration: none; display: block;">Go to Homepage</a>
</button>
        </form>
    </div>

</body>
</html>
