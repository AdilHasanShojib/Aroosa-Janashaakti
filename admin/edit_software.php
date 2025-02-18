<?php
session_start();
//include '../config.php';


$host = "localhost";  // Change if using an external database
$user = "root";       // Default user for local development
$pass = "";           // Default password (leave blank for XAMPP)
$dbname = "aroosa_janashakti";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}






if (!isset($_SESSION["admin_logged_in"])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: manage_software.php");
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM software_products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: manage_software.php");
    exit();
}

$software = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $file = $_POST['file_link'];

    $sql = "UPDATE software SET name=?, description=?, price=?, file=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $description, $price, $file, $id);

    if ($stmt->execute()) {
        header("Location: manage_software.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Software</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-container">
    <h2>Edit Software</h2>
    <form method="POST">
        <input type="text" name="name" value="<?php echo htmlspecialchars($software['name']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($software['description']); ?></textarea>
        <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($software['price']); ?>" required>
        <input type="text" name="file_link" value="<?php echo htmlspecialchars($software['file']); ?>" required> <br> <br>
        <button type="submit">Update Software</button>
    </form>
</div>

</body>
</html>
