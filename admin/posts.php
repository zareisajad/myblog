<?php
require_once 'session.php';

// Check if the user is logged in
requireLogin();
?>

<?php include '../db_config.php'; ?>

<?php
// Check if the form is submitted for deleting a post
if (isset($_POST["delete"]) && isset($_POST["post_id"])) {
    $postID = $_POST["post_id"];

    // Prepare and execute the SQL statement to delete the post
    $sql = "DELETE FROM blog WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postID);
    $stmt->execute();

    // Close the statement
    $stmt->close();

    // Redirect to the posts page
    header("Location: posts.php");
    exit();
}

// Fetch all posts from the database
$sql = "SELECT * FROM blog ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<?php include '../includes/head.php'; ?>
<?php include '../includes/navbar.php'; ?>

    <h1>Posts</h1>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["title"]; ?></td>
                        <td><?php echo $row["content"]; ?></td>
                        <td><?php echo $row["created_at"]; ?></td>
                        <td>
                        <a href="edit-post.php?id=<?php echo $row["id"]; ?>">Edit</a>
                            <form class="delete-form" method="post" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                <input type="hidden" name="post_id" value="<?php echo $row["id"]; ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">No posts available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php include '../includes/footer.php'; ?>

<?php
// Close the connection
$conn->close();
?>
