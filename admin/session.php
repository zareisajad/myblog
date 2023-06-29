<?php
session_start();

function requireLogin() {
    if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
        header("Location: login.php");
        exit();
    }
}

function login($username, $password) {
    // Hardcoded validation for username and password
    $validUsername = "marshall.sg";
    $validPassword = "Sajad19921998";

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION["loggedIn"] = true;
        $_SESSION["username"] = $username;
        header("Location: posts.php");
        exit();
    } else {
        return "Invalid username or password";
    }
}

function logout() {
    $_SESSION = array();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
