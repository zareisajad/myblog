<?php include 'db_config.php'; ?>
<?php include './includes/head.php'; ?>
<?php include './includes/navbar.php'; ?>
<div class="container mt-4 index" >
<h1>Sajad Zarei</h1>

<p>
Hi, I'm Sajad, a web developer from Iran. <br>
four years ago, I was frying hamburgers at a fast food restaurant.
And I'm now a full-stack developer and also a vegan. But don't worry, there's no need to panic!
</p>
<p>
    I'm currently a co-founder at <a href="https://ponezweb.com" rel="nofollow">Ponezweb</a>. <br>
    and working on some exciting projects which I'll write about on <a href="blog.php">my blog</a>.
    I also publish <a href="daily.php">daily updates here</a> sometimes.
</p>
<p>
    Altough I mostly write in Persian here but feel free to contact with me via <a href="mailto:zareisajad@protonmail.com">Email</a>.
</p>

<small>- Have a Great Day.</small>


<hr>

<h3>Latest Entries</h3>

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
