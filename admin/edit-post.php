<?php
require_once 'session.php';

// Check if the user is logged in
requireLogin();
?>

<?php include '../db_config.php'; ?>
<?php
// Check if the form is submitted for updating the post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data
    $postID = $_POST["post_id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $image = $_FILES["image"]["name"];
    // Check if the image file is uploaded
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        // Move the uploaded image to the desired location
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $image);
    }
    // Prepare and execute the SQL statement to update the post
    $sql = "UPDATE blog SET title = ?, content = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $content, $image, $postID);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Redirect to the posts page
    header("Location: posts.php");
    exit();
}

// Fetch the post data based on the provided post ID from the URL parameter
if (isset($_GET["id"])) {
    $postID = $_GET["id"];

    // Prepare and execute the SQL statement to retrieve the post
    $sql = "SELECT * FROM blog WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postID);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<?php include '../includes/head.php'; ?>
<script src="https://cdn.tiny.cloud/1/cr4evegjpbhzdmd98i7l0g2wxy08hzh3c9bwixxz7p2v273p/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<?php include '../includes/navbar.php'; ?>

    <h1>Edit Post</h1>

    <?php if ($post) : ?>
        <form method="post" action="edit-post.php" enctype="multipart/form-data">
            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
            <label for="title">Title:</label><br>
            <input type="text" name="title" id="title" value="<?php echo $post['title']; ?>"><br><br>
            <label for="content">Content:</label><br>
            <textarea name="content" id="content" rows="5"><?php echo $post['content']; ?></textarea><br><br>
            <label for="image">Image:</label><br>
            <input type="file" name="image" id="image"><br><br>
            <button type="submit">Update</button>
        </form>
    <?php else : ?>
        <p>Post not found.</p>
    <?php endif; ?>
    <?php include '../includes/footer.php'; ?>
