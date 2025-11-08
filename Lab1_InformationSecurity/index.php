<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
    echo "<h1>Welcome, $username!</h1>";
    echo "<p>You are successfully logged in.</p>";
    echo '<a href="logout.php">Logout</a>';
} else {
    header("Location: register_user_form.php");
    exit;
}
?>
