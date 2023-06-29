<?php include 'db_config.php'; ?>
<?php include './includes/head.php'; ?>
<?php include './includes/navbar.php'; ?>
<div class="container mt-4">
<h1>Sajad's Blog</h1>


    <?php
    $sql = "SELECT * FROM blog ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<img src='uploads/" . $row["image"] . "' alt='Post Image'>";
            echo "<p class='post-date'>" . $row["created_at"] . "</p> ";

            echo "<a href='post.php?id=" . $row["id"] . "'><button>Read more</button></a> <br> ";
            echo "</div>";
        }
    } else {
        echo "No posts available.";
    }
    ?>
</div>
<?php include './includes/footer.php'; ?>

<?php $conn->close(); ?>
