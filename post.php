<?php include 'db_config.php'; ?>
<?php include './includes/head.php'; ?>
<?php include './includes/navbar.php'; ?>
<div class="container mt-4">

    <?php
    // Check if the post ID is provided in the query string
    if (isset($_GET["id"])) {
        $post_id = $_GET["id"];

        // Retrieve the post details from the database
        $sql = "SELECT * FROM blog WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a post was found with the given ID
        if ($result->num_rows > 0) {
            $post = $result->fetch_assoc();
            ?>
            <div class="post">
                <h2><?php echo $post["title"]; ?></h2>
                <p><?php echo $post["content"]; ?></p>
                <img src="uploads/<?php echo $post["image"]; ?>" alt="Post Image">
                <p class="post-date">Posted on: <?php echo $post["created_at"]; ?></p>
            </div>
            <?php
        } else {
            echo "No post found.";
        }

        $stmt->close();
    } else {
        echo "Invalid post ID.";
    }
    ?>

</div>
<?php include './includes/footer.php'; ?>
<?php $conn->close(); ?>
