<?php
    include '../sql/connection.php';
    include '../auth/session.php';
    if (isset($_POST['newEmail_confirm'])) {
       
        $user = $_SESSION['user_id']; 
        $newEmail = $_POST['newEmail']; 

        $stmt = $connection->prepare('UPDATE users SET email = ? WHERE id = ?');
        $stmt->bind_param('si', $newEmail, $user);

        if ($stmt->execute()) {
            $message = 'success';
        } else {
            $message = 'could not change email';
        }

        $stmt->close();
        header("Location: ../pages/settings-page.php?message=success");
        exit;
    }
?>
