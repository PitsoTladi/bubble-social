<?php
session_start();
include '../sql/connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Not logged in";
    header('Location: bubble-login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Only process POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['message'] = "Invalid request method";
    header('Location: bubble-welcome.php');
    exit;
}

// Check if newPost is set
if (!isset($_POST['newPost'])) {
    $_SESSION['message'] = "Form submission error";
    header('Location: bubble-welcome.php');
    exit;
}

$content = trim($_POST['newPostInput'] ?? '');
$imagePath = null;

// Validate content
if (empty($content)) {
    $_SESSION['message'] = "Post content cannot be empty!";
    header('Location: bubble-welcome.php');
    exit;
}

// Handle media upload if present
if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp = $_FILES['mediaUpload']['tmp_name'];
    $fileName = uniqid() . "_" . basename($_FILES['mediaUpload']['name']);
    $targetFile = $uploadDir . $fileName;

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'webm'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        $_SESSION['message'] = "Invalid file type. Allowed: jpg, jpeg, png, gif, mp4, mov, avi, webm";
        header('Location: bubble-welcome.php');
        exit;
    }

    if (!move_uploaded_file($fileTmp, $targetFile)) {
        $_SESSION['message'] = "Failed to upload media.";
        header('Location: bubble-welcome.php');
        exit;
    }

    $imagePath = $fileName;
}

// Insert into database
$stmt = $connection->prepare("INSERT INTO posts (user_id, content, image_path) VALUES (?, ?, ?)");

if (!$stmt) {
    $_SESSION['message'] = "Database error: " . $connection->error;
    header('Location: bubble-welcome.php');
    exit;
}

$stmt->bind_param("iss", $user_id, $content, $imagePath);

if (!$stmt->execute()) {
    $_SESSION['message'] = "Error creating post: " . $stmt->error;
} else {
    $_SESSION['message'] = "Post created successfully! ";
}

$stmt->close();
$connection->close();

header('Location: bubble-welcome.php');
exit;
?>