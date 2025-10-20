<?php

include '../sql/connection.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: bubble-login.php');
    exit;
}

if (isset($_POST['newPost'])) {
    $user_id = $_SESSION['user_id'];
    $postContent = $_POST['newPostInput'];
    $imagePath = null;

    // Handle file upload
    if (isset($_FILES['mediaUpload']) && $_FILES['mediaUpload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['mediaUpload']['tmp_name'];
        $fileName = $_FILES['mediaUpload']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'webm'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = '../uploads/';

            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            $destPath = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $imagePath = $newFileName;
            } else {
                echo "<p style='color:red;'>Error moving the uploaded file.</p>";
            }
        } else {
            echo "<p style='color:red;'>Upload failed. Allowed file types: " . implode(", ", $allowedExtensions) . "</p>";
        }
    }

    
    if ($imagePath === null) {
        $imagePath = null;  // Important: null to match nullable DB column
    }

    $stmt = $connection->prepare("INSERT INTO posts (user_id, content, image_path, timestamp) VALUES (?, ?, ?, NOW())");
    if ($stmt === false) {
        die("Prepare failed: " . $connection->error);
    }

    $stmt->bind_param("iss", $user_id, $postContent, $imagePath);

    if ($stmt->execute()) {
        // Prevent form resubmission by redirecting
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<p style='color:red;'>Error inserting post: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

//$connection->close();
?>
