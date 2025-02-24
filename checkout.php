<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include 'config.php';

if (isset($_GET['id'])) {
    $software_id = $_GET['id'];
    $sql = "SELECT * FROM software_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $software_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $software = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $software_name = $_POST['software_name'];

    $mail = new PHPMailer(true);
    $success_message = "";
    $failed_message = "";

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change this if using another provider
        $mail->SMTPAuth = true;
        $mail->Username = 'adiltalukder6284@gmail.com'; // Replace with your Gmail
        $mail->Password = 'pklj glqg vzal gfsk'; // Use an App Password instead of your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Details
        $mail->setFrom('adiltalukder6284@gmail.com', $name); // Sender Email & Name
        $mail->addAddress('adilhasanshojib@gmail.com'); // Admin Email

        $mail->Subject = "New Software Checkout Request";
        $mail->Body = "User: $name\nEmail: $email\nPhone: $phone\nRequested Software: $software_name";

        $mail->send();
        $success_message = "<p style='color: green; font-weight: bold; text-align: center;'>Checkout request sent successfully!</p>";
    } catch (Exception $e) {
        $failed_message= "<p style='color: red; font-weight: bold; text-align: center;'>Failed to send email. Error: {$mail->ErrorInfo}</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
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

        .checkout{
            margin-top: 80px;
            font-size: 20px;
        }



</style>
</head>
<body>

 
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
   <div class="checkout"> 
    <h2>Checkout - <?php echo htmlspecialchars($software['name']); ?></h2>

 <?php 
    if (!empty($success_message)) {
        echo $success_message;
    } elseif (!empty($failed_message)) {
        echo $failed_message;
    }
    ?>



   </div>
    <form method="post" class="login-container">
        <input type="hidden" name="software_name" value="<?php echo htmlspecialchars($software['name']); ?>">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Your Email" required><br>
        <input type="text" name="phone" placeholder="Your Phone" required><br>
        <button type="submit" style="background-color: #25d366; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius:5px; cursor: pointer;">Request Checkout</button> <br> <br>
        

    </form>
</body>
</html>
