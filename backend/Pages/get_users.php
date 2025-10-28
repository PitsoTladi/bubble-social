
<?php
// get_users.php
session_start();
header('Content-Type: application/json');
require_once 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'You must be logged in.'
    ]);
    exit;
}

$current_user_id = $_SESSION['user_id'];

$conn = getDBConnection();

// Get all users except current user
$stmt = $conn->prepare("SELECT id, full_name FROM users WHERE id != ? ORDER BY full_name");
$stmt->bind_param("i", $current_user_id);

$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode([
    'success' => true,
    'users' => $users
]);

$stmt->close();
$conn->close();
?>