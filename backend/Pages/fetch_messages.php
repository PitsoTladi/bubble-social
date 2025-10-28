<?php
include '../sql/connection.php';

$user = intval($_GET['user']);
$receiver_id = intval($_GET['receiver_id']);

$query = "
SELECT m.*, u.full_name AS sender_name 
FROM messages m 
JOIN users u ON u.id = m.sender_id 
WHERE (m.sender_id = $user AND m.receiver_id = $receiver_id)
   OR (m.sender_id = $receiver_id AND m.receiver_id = $user)
ORDER BY m.timestamp ASC";

$result = $connection->query($query);

if (!$result) {
    die("Error executing query: " . $connection->error); // Check for any SQL errors
}

while ($row = $result->fetch_assoc()) {
    $class = ($row['sender_id'] == $user) ? 'sent' : 'received';
    echo "<div class='msg $class'><strong>{$row['sender_name']}:</strong> " . htmlspecialchars($row['message_content']) . "</div>";
}
?>
