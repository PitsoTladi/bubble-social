<?php
include '../sql/connection.php';


$user = intval($_GET['user']);
$receiver_id = intval($_GET['receiver_id']);

$query = "
SELECT * FROM messages 
WHERE (sender_id = $user AND receiver_id = $receiver_id)
   OR (sender_id = $receiver_id AND receiver_id = $user)
ORDER BY timestamp ASC";

$result = $connection->query($query);

while ($row = $result->fetch_assoc()) {
    $class = ($row['sender_id'] == $user) ? 'sent' : 'received';
    echo "<div class='msg $class'><strong>{$row['sender_name']}:</strong> " . htmlspecialchars($row['message_content']) . "</div>";
}
?>
