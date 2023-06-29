<?php
require_once 'session.php';

// Check if the user is logged in
requireLogin();
?>

<?php include '../db_config.php'; ?>
<?php


// Create the blog table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"]["name"];

    // Check if the form fields are not empty
    if (!empty($title) && !empty($content)) {
        // Move the uploaded image to the desired location
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $image);

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO blog (title, content, image) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $title, $content, $image);
        $stmt->execute();

        // Check if the query was successful
        if ($stmt->affected_rows > 0) {
            header("Location: /index.php");
            exit();
        } else {
            echo "Error creating post: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();

    } else {
        echo "Please fill in all the required fields.";
    }
}

// Close the connection
$conn->close();
?>

<?php include '../includes/head.php'; ?>
<script src="https://cdn.tiny.cloud/1/cr4evegjpbhzdmd98i7l0g2wxy08hzh3c9bwixxz7p2v273p/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php include '../includes/navbar.php'; ?>

<div class="post-form">
    <h2>Add New Post</h2>
    <form method="POST" action="create-post.php" enctype="multipart/form-data" >
        <input type="text" name="title" placeholder="title" required><br><br>
        <textarea name="content" required> </textarea><br><br>
    <input type="file" name="image" id="image">
    <input type="submit" value="Create Post">
    </form>
</div>
<?php include '../includes/footer.php'; ?>
