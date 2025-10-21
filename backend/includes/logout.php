<?php
session_start();

if (isset($_POST['logoutbtn'])) {
    session_destroy();
    header('Location: ../auth/bubble.php');
    exit();
} elseif (isset($_POST['cancel'])) {
    header('Location: ../pages/settings-page.php');
    exit();
}
?>


