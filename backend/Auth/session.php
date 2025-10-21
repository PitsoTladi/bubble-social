<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/user-profile.php');
    exit;
}
?>


<!--<a href="logout.php">Logout</a>-->
