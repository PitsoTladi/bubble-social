<?php
include '../sql/connection.php';

$email = $_POST['email'];
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

$stmt = $connection->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
$stmt->bind_param("ss", $new_password, $email);

if ($stmt->execute()) {
    echo "Password successfully reset.";
} else {
    echo "Failed to reset password.";
}

$connection->close();
?>
