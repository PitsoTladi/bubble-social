<?php
session_start();
include '../sql/connection.php';

// Include post creation logic
include 'new-post-form.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: bubble-login.php');
    exit;
}

// Get current user info
$user_id = $_SESSION['user_id'];
$stmt = $connection->prepare("SELECT full_name, profile_picture FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
if (!$res || $res->num_rows !== 1) {
    die("User not found.");
}
$currentUser = $res->fetch_assoc();
$stmt->close();

// Fetch posts
$sql = "
    SELECT
        posts.id,
        posts.user_id,
        posts.content,
        posts.image_path,
        posts.timestamp,
        users.full_name AS username,
        users.profile_picture
    FROM posts
    JOIN users ON posts.user_id = users.id
    ORDER BY posts.timestamp DESC
";
$postsResult = $connection->query($sql);
if (!$postsResult) {
    die("Error fetching posts: " . $connection->error);
}

$posts = [];
while ($row = $postsResult->fetch_assoc()) {
    $postTime = strtotime($row['timestamp']);
    $diff = time() - $postTime;
    if ($diff < 60) {
        $timeAgo = $diff . "s ago";
    } elseif ($diff < 3600) {
        $timeAgo = floor($diff / 60) . "m ago";
    } elseif ($diff < 86400) {
        $timeAgo = floor($diff / 3600) . "h ago";
    } else {
        $timeAgo = floor($diff / 86400) . "d ago";
    }

    $profilePic = !empty($row['profile_picture'])
        ? "../uploads/" . $row['profile_picture']
        : './../../pp pics/default-avatar.png';

    $posts[] = [
        'username' => $row['username'],
        'profile_pic' => $profilePic,
        'time' => $timeAgo,
        'content' => $row['content'],
        'image_path' => $row['image_path']
    ];
}

// DO NOT close the connection here - keep it open for post_handler.php
// $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Welcome to Bubble</title>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="../../frontend/styles-css/welcomeStyle.css" />
  <style>
    #mediaUpload {
      display: none;
    }
    .attachment {
      cursor: pointer;
      font-size: 24px;
      user-select: none;
      margin-left: 8px;
      vertical-align: middle;
    }
  </style>
</head>
<body>

<!-- Include Navbar -->
<?php include '../includes/navbar.php'; ?>

<!-- Flash message -->
<?php if (isset($_SESSION['message'])): ?>
  <p style="color: green; text-align: center;"><?= htmlspecialchars($_SESSION['message']) ?></p>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<!-- Include New Post Form -->
<?php include '../includes/new-post-form.php'; ?>

<!-- Feed -->
<main class="feed-container" id="feedContainer">
  <?php if (empty($posts)): ?>
    <p>No posts yet. Be the first to post something!</p>
  <?php else: ?>
    <?php foreach ($posts as $post): ?>
      <div class="post">
        <div class="post-header" style="display: flex; align-items: center; gap: 10px;">
          <img src="<?= htmlspecialchars($post['profile_pic']) ?>" alt="<?= htmlspecialchars($post['username']) ?>'s profile" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;" />
          <span class="post-user">&#128100; <?= htmlspecialchars($post['username']) ?></span>
          <span class="post-time" style="margin-left: auto; font-size: 12px; color: #aaa;"><?= htmlspecialchars($post['time']) ?></span>
        </div>
        <div class="post-content">
          <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
        <?php if (!empty($post['image_path'])): ?>
          <?php
            $ext = strtolower(pathinfo($post['image_path'], PATHINFO_EXTENSION));
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $videoExtensions = ['mp4', 'mov', 'avi', 'webm'];
          ?>
          <div class="post-media" style="margin-top:8px;">
            <?php if (in_array($ext, $imageExtensions)): ?>
              <img src="<?= htmlspecialchars("../uploads/" . $post['image_path']) ?>" alt="Post media" style="max-width: 100%;" />
            <?php elseif (in_array($ext, $videoExtensions)): ?>
              <video controls style="max-width: 100%;">
                <source src="<?= htmlspecialchars("../uploads/" . $post['image_path']) ?>" type="video/<?= $ext === 'mov' ? 'quicktime' : $ext ?>">
                Your browser does not support the video tag.
              </video>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</main>

<script src="../../frontend/js/welcomeScript.js"></script>
</body>
</html>