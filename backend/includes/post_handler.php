<?php
session_start();

include '../sql/connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: bubble-login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newPost'])) {
    $content = trim($_POST['newPostInput']);
    $imagePath = null;

    // Validate content
    if (empty($content)) {
        $_SESSION['message'] = "Post content cannot be empty!";
        header('Location: bubble-welcome.php');
        exit;
    }

    // Handle media upload (optional)
    if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        
        // Create uploads directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp = $_FILES['mediaUpload']['tmp_name'];
        $fileName = uniqid() . "_" . basename($_FILES['mediaUpload']['name']);
        $targetFile = $uploadDir . $fileName;

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'webm'];
        $fileExtension = strtolower(pathinfo($_FILES['mediaUpload']['name'], PATHINFO_EXTENSION));
        
        if (in_array($fileExtension, $allowedExtensions)) {
            if (move_uploaded_file($fileTmp, $targetFile)) {
                $imagePath = $fileName;
            } else {
                $_SESSION['message'] = "Failed to upload media.";
                header('Location: bubble-welcome.php');
                exit;
            }
        } else {
            $_SESSION['message'] = "Invalid file type. Allowed: jpg, jpeg, png, gif, mp4, mov, avi, webm";
            header('Location: bubble-welcome.php');
            exit;
        }
    }

    // Insert post into database
    $stmt = $connection->prepare("INSERT INTO posts (user_id, content, image_path, timestamp) VALUES (?, ?, ?, NOW())");
    
    if (!$stmt) {
        $_SESSION['message'] = "Database error: " . $connection->error;
        header('Location: bubble-welcome.php');
        exit;
    }
    
    $stmt->bind_param("iss", $user_id, $content, $imagePath);
    
    if (!$stmt->execute()) {
        $_SESSION['message'] = "Error creating post: " . $stmt->error;
        error_log("Post insert failed - Error: " . $stmt->error);
        error_log("User ID: $user_id, Content: $content, Image: $imagePath");
    } else {
        $_SESSION['message'] = "Post created successfully!";
    }
    
    $stmt->close();
    
    header('Location: bubble-welcome.php');
    exit;
    $connection->close();
}
?>