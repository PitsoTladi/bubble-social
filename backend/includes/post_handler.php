<?php
session_start();
include '../sql/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Not logged in";
    header('Location: ../auth/bubble-login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Ensure POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['message'] = "Invalid request method";
     header('Location: ../pages/bubble-welcome.php');
    exit;
}

// Validate post content
$content = trim($_POST['newPostInput'] ?? '');
if (empty($content)) {
    $_SESSION['message'] = "Post content cannot be empty!";
    header('Location: ../pages/bubble-welcome.php');
    exit;
}

$imagePath = null;

// Handle media upload
if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp = $_FILES['mediaUpload']['tmp_name'];
    $originalName = basename($_FILES['mediaUpload']['name']);
    $fileName = uniqid() . "_" . $originalName;
    $targetFile = $uploadDir . $fileName;

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'webm'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        $_SESSION['message'] = "Invalid file type. Allowed: jpg, jpeg, png, gif, mp4, mov, avi, webm";
         header('Location: ../pages/bubble-welcome.php');;
        exit;
    }

    if (!move_uploaded_file($fileTmp, $targetFile)) {
        $_SESSION['message'] = "Failed to upload media.";
         header('Location: ../pages/bubble-welcome.php');;
        exit;
    }

    $imagePath = $fileName;
}

// Insert post into database
$stmt = $connection->prepare("INSERT INTO posts (user_id, content, image_path) VALUES (?, ?, ?)");

if (!$stmt) {
    $_SESSION['message'] = "Database error: " . $connection->error;
    header('Location: ../pages/bubble-welcome.php');;
    exit;
}

$stmt->bind_param("iss", $user_id, $content, $imagePath);

if (!$stmt->execute()) {
    $_SESSION['message'] = "Error creating post: " . $stmt->error;
} else {
    $_SESSION['message'] = "Post created successfully!";
}

$stmt->close();
$connection->close();

 header('Location: ../pages/bubble-welcome.php');;
exit;
?>
