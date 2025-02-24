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

$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$title = urlencode($blog['title']);

//echo $currentURL;

//Comment Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment_submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);

    if (!empty($name) && !empty($comment)) {
        $comment_sql = "INSERT INTO comments (blog_id, name, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($comment_sql);
        $stmt->bind_param("iss", $id, $name, $comment);
        $stmt->execute();
    }
}

//Comment Edit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_comment_submit'])) {
    $comment_id = $_POST['comment_id'];
    $updated_comment = htmlspecialchars($_POST['updated_comment']);

    if (!empty($updated_comment)) {
        $update_sql = "UPDATE comments SET comment = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $updated_comment, $comment_id);
        $stmt->execute();
    }
}

//Comment Deletion
if (isset($_GET['delete_comment'])) {
    $comment_id = $_GET['delete_comment'];
    $delete_sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    header("Location: blog_post.php?id=" . $id);
    exit();
}

// Fetch Comments
$comment_query = "SELECT * FROM comments WHERE blog_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($comment_query);
$stmt->bind_param("i", $id);
$stmt->execute();
$comments_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>

            .logo-title {
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

        .logout {
            position: absolute;
            right: 20px;
        }

        .single-blog {
            text-align: center;
            max-width: 800px;
            margin: auto;
        }

        .single-blog h3 {
            font-size: 25px;
            font-weight: bold;
            margin-top: 50px;
        }

        .single-blog img {
            display: block;
            margin: 20px auto;
            width: 100%;
            max-width: 600px;
            height: auto;
            border-radius: 10px;
        }

        .single-blog p {
            font-size: 17px;
            line-height: 1.6;
            text-align: left;
        }
        .comment-section {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comment-section h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .comment-form input, .comment-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .comment-form button {
            background: #f68b1f;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .comment {
            background: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #f68b1f;
            border-radius: 5px;
        }

        .comment .comment-author {
            font-weight: bold;
        }

        .comment .comment-actions {
            text-align: right;
            margin-top: 10px;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
        }

        .edit-btn {
            background-color: #25d366;
            color: black;
        }

        .delete-btn {
            background-color: red;
            color: white;
        }

        .edit-form {
            display: none;
            margin-top: 10px;
        }

        .edit-form textarea {
            width: 100%;
            height: 60px;
        }


   .social-share {
   
    margin-top: 20px;
    text-align: center;
}

.social-share h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.social-share a {
    display: inline-block;
    margin: 5px;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-size: 14px;
    transition: 0.3s ease-in-out;
}

.facebook {
    background: #3b5998;
}

.twitter {
    background: #1da1f2;
}

.linkedin {
    background: #0077b5;
}

.whatsapp {
    background: #25d366;
}

.social-share a:hover {
    opacity: 0.8;
}

 </style>
</head>
<body>




    <header>
        <div style="width: 100%; height: 1vh; background-color: #F68B1F;"></div>
        <div class="logo-title"><h1>AROOSA JANASHAKTI</h1></div>
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Home</a>
            <a href="software.php"><i class="fas fa-shopping-cart"></i> Software Shop</a>
            <a href="blog.php"><i class="fas fa-newspaper"></i> Blog</a>
            <a href="admin/admin_login.php" class="logout"><i class="fas fa-user-shield"></i> Admin</a>
        </nav>
    </header>




    <div class="single-blog">
        <h3><?php echo htmlspecialchars($blog["title"]); ?></h3>
        <img src="contents/<?php echo htmlspecialchars($blog["image"]); ?>" alt="Blog Image">
        <p><?php echo nl2br(htmlspecialchars($blog["content"])); ?></p>
    </div>


  
    <div class="social-share">
    <h3>Share this Post:</h3>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($currentURL); ?>" target="_blank" class="facebook">

        <i class="fab fa-facebook-f"></i> Facebook
    </a>
    <a href="https://twitter.com/intent/tweet?url=<?php echo $currentURL; ?>&text=<?php echo $title; ?>" target="_blank" class="twitter">
        <i class="fab fa-twitter"></i> Twitter
    </a>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $currentURL; ?>" target="_blank" class="linkedin">
        <i class="fab fa-linkedin-in"></i> LinkedIn
    </a>
    <a href="https://api.whatsapp.com/send?text=<?php echo $title . ' ' . $currentURL; ?>" target="_blank" class="whatsapp">
        <i class="fab fa-whatsapp"></i> WhatsApp
    </a>
</div>





    <!-- Comment Section -->
    <div class="comment-section">
        <h3>Leave a Comment</h3>
        <form method="POST" class="comment-form">
            <input type="text" name="name" placeholder="Your Name" required>
            <textarea name="comment" rows="4" placeholder="Your Comment" required></textarea>
            <button type="submit" name="comment_submit">Post Comment</button>
        </form>

        <div class="comment-list">
            <h3>Comments:</h3>
            <?php
            if ($comments_result->num_rows > 0) {
                while ($comment = $comments_result->fetch_assoc()) {
                    echo '<div class="comment">
                            <p class="comment-author">' . htmlspecialchars($comment["name"]) . '</p>
                            <p>' . nl2br(htmlspecialchars($comment["comment"])) . '</p>
                            <p class="comment-date">' . $comment["created_at"] . '</p>
                            <div class="comment-actions">
                                <button class="edit-btn" onclick="showEditForm(' . $comment["id"] . ')">Edit</button>
                                <a href="?id=' . $id . '&delete_comment=' . $comment["id"] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this comment?\')">Delete</a>
                            </div>
                            <form method="POST" class="edit-form" id="edit-form-' . $comment["id"] . '">
                                <input type="hidden" name="comment_id" value="' . $comment["id"] . '">
                                <textarea name="updated_comment">' . htmlspecialchars($comment["comment"]) . '</textarea>
                                <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;" name="edit_comment_submit">Update</button>
                            </form>
                          </div>';
                }
            } else {
                echo "<p>No comments yet. Be the first to comment!</p>";
            }
            ?>
        </div>
    </div>

    <script>
        function showEditForm(commentId) {
            document.getElementById("edit-form-" + commentId).style.display = "block";
        }
    </script>

</body>
</html>
