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

// Handle software deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM software_products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: manage_software.php");
        exit();
    }
}

// Fetch all software products
$sql = "SELECT * FROM software_products ORDER BY price DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Software</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <h1>Manage Software</h1>
    <nav>
        <a href="admin_dashboard.php">Home</a>
        <a href="admin_logout.php">Logout</a>
    </nav>
</header>

<div class="admin-container">
    <h2>Add New Software</h2>
    <form action="add_software.php" method="POST">
        <input type="text" name="name" placeholder="Software Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="file_link" placeholder="Download/Purchase Link" required> <br> <br>
        <button type="submit">Add Software</button>
    </form>

    <h2>Software List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td>$<?php echo htmlspecialchars($row['price']); ?></td>
            <td>
                <a href="edit_software.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="manage_software.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
