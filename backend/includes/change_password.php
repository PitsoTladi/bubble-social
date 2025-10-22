<?php
include '../auth/session.php';
//session_start();
include '../sql/connection.php';


if (isset($_POST['newpassbtn'])) {
    $user_id = $_SESSION['user_id'];
    $password = $_POST['currentPass'];
    $new_password = $_POST['newPass'];
    $new_pass_confirm = $_POST['newPass-confirm'];

    if ($new_password !== $new_pass_confirm) {
        $_SESSION['password_change_error'] = 'New passwords do not match.';
    } else {
        $stmt = $connection->prepare('SELECT password_hash FROM users WHERE id = ?');
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password_hash'])) {
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $connection->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
            $update_stmt->bind_param('si', $hashed_new_password, $user_id);
            if ($update_stmt->execute()) {
                $_SESSION['password_change_success'] = 'Password updated successfully.';
            } else {
                $_SESSION['password_change_error'] = 'Failed to update password.';
            }
        } else {
            $_SESSION['password_change_error'] = 'Incorrect current password.';
        }
    }

    // Redirect back to settings page
    header('Location: ../pages/settings-page.php');
    exit();
}
?>
