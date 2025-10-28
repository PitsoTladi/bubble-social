<?php
//session_start();
include '../sql/connection.php';
include '../auth/session.php';

// Example: logged in user
$user = $_SESSION['user_id'];

if (isset($_POST['receiver_id']) && isset($_POST['message_content'])) {
    $receiver_id = intval($_POST['receiver_id']);
    $message = trim($_POST['message_content']);

    // Get sender name
    $result = $connection->query("SELECT full_name FROM users WHERE id = $user");
    $row = $result->fetch_assoc();
    $sender_name = $row['full_name'];

    $stmt = $connection->prepare("INSERT INTO messages (sender_id, sender_name, receiver_id, message_content) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $user, $sender_name, $receiver_id, $message);
    $stmt->execute();
    $stmt->close();
}
?>
