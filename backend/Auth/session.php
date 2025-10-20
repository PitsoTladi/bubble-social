<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/user-profile.php');
    exit;
}
?>

<h1>Welcome! You are logged in.</h1>
<!--<a href="logout.php">Logout</a>-->
