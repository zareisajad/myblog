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
            echo "<div class='post' style='direction:rtl'>";
            echo "<a href='post.php?id=" . $row["id"] . "'> <h2 class='archive-post-title'>" . $row["title"] . "</h2> </a>";
            $timestamp = $row["created_at"];
            $day = date('d', strtotime($timestamp));
            $month = date('M', strtotime($timestamp));
            $year = date('Y', strtotime($timestamp));
            echo "<p class='post-date'>" . $year . " " . $day . "". $month ."  </p> ";
            echo "</div>";
        }
    } else {
        echo "No posts available.";
    }
    ?>


</div>
<?php include './includes/footer.php'; ?>

<?php $conn->close(); ?>
