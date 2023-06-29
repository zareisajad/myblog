<?php
require_once 'session.php';

// Check if the user is already logged in
if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === true) {
    header("Location: posts.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $loginError = login($username, $password);
}
?>
<?php include '../includes/head.php'; ?>
<?php include '../includes/navbar.php'; ?>
    <h1>Login</h1>
    <?php if (isset($loginError)) : ?>
        <p><?php echo $loginError; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit">Login</button>
    </form>

<?php include '../includes/footer.php'; ?>