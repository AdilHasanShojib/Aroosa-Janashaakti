<?php
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
    $software_name = $_POST['software_name'];

    $to = "adilhasanshojib@gmail.com"; // Replace with your admin email
    $subject = "New Software Checkout Request";
    $message = "User: $name\nEmail: $email\nRequested Software: $software_name";
    $headers = "From: noreply@yourwebsite.com";

    if (mail($to, $subject, $message, $headers)) {
        echo "<p style='color: green;'>Checkout request sent successfully!</p>";
    } else {
        echo "<p style='color: red;'>Failed to send email. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Checkout - <?php echo htmlspecialchars($software['name']); ?></h2>
    <form method="post" class="login-container">
        <input type="hidden" name="software_name" value="<?php echo htmlspecialchars($software['name']); ?>">
        <input type="text" name="name" placeholder="Your Name" required><br>
        <input type="email" name="email" placeholder="Your Email" required><br>
        <button type="submit">Request Checkout</button>
    </form>
</body>
</html>
