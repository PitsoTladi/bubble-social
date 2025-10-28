<?php

include '../sql/connection.php';
include '../auth/session.php';

$user = $_SESSION['user_id'];

// Handle selecting a receiver
$receiver_name = '';
$receiver_id = null;

if (isset($_GET['username'])) {
    $receiver_name = trim($_GET['username']);
    $stmt = $connection->prepare("SELECT id FROM users WHERE full_name = ?");
    $stmt->bind_param("s", $receiver_name);
    $stmt->execute();
    $stmt->bind_result($receiver_id);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messaging Interface</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 30px; margin-top : 50px }
        .chat-box {;background: white; padding: 20px; width: 400px; margin: 5% auto; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 600px; }
        .message-container { height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
        .msg { margin: 5px 0; padding: 8px; border-radius: 5px; }
        .sent { background: #d1ffd6; text-align: right; }
        .received { background: #f0f0f0; text-align: left; }
        .username-input, .message-input { width: 100%; padding: 8px; margin: 5px 0; }
        .send-btn { width: 100%; padding: 10px; background: purple; color: white; border: none; cursor: pointer; border-radius: 5px; }
        .send-btn:hover { background: #0056b3; }
    </style>
</head>
<body>

<?php include '../includes/navbar.php' ?>
<div class="chat-box">
    <h2>Private Messaging</h2>

    <form method="get">
        <input type="text" name="username" class="username-input" placeholder="Enter username..." value="<?= htmlspecialchars($receiver_name) ?>" required>
        <button type="submit" class="send-btn">Chat</button>
    </form>

    <?php if ($receiver_id): ?>
        <h3>Chat with <?= htmlspecialchars($receiver_name) ?></h3>
        <div class="message-container" id="messages"></div>

        <form id="messageForm">
            <input type="hidden" name="receiver_id" value="<?= $receiver_id ?>">
            <textarea name="message_content" class="message-input" placeholder="Type your message..." required></textarea>
            <button type="submit" class="send-btn">Send</button>
        </form>
    <?php elseif ($receiver_name): ?>
        <p style="color:red;">User not found.</p>
    <?php endif; ?>
</div>

<script>
// Auto-load messages every 2 seconds
let receiver_id = "<?= $receiver_id ?>";
let user = "<?= $user ?>";

if (receiver_id) {
    function loadMessages() {
        fetch(`fetch_messages.php?receiver_id=${receiver_id}&user=${user}`)
            .then(res => res.text())
            .then(html => {
                document.getElementById('messages').innerHTML = html;
            });
    }

    setInterval(loadMessages, 2000);
    loadMessages();

    // Handle sending new message
    document.getElementById('messageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('send_message.php', {
            method: 'POST',
            body: formData
        }).then(res => res.text())
          .then(() => {
              this.reset();
              loadMessages();
          });
    });
}
</script>
</body>
</html>
