<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profile Page</title>
  <link rel="stylesheet" href="../../frontend/styles-css/profile-styles.css" />
</head>
<body>

<?php
  include '../auth/session.php';
  include '../sql/connection.php';

  $user = $_SESSION['user_id'];
  if(!isset($user)){
    header('Location: ../auth/bubble.php');
    exit();
  }

  $userInfo = 'SELECT full_name,cover_pic,bio,profile_picture FROM users WHERE id = ?';
  $stmt = $connection -> prepare($userInfo);
  $stmt -> bind_param('i', $user);
  $stmt -> execute();

  $result = $stmt -> get_result();
  $userInfo = $result -> fetch_assoc();
  $stmt ->close();

  $cover_image = !empty($userInfo['cover_pic']) ? '../cover img/' . $userInfo['cover_pic'] : '../../cover img/defaultCover.jpg';

  $profilePic = !empty($userInfo['profile_picture']) 
    ? '../uploads/' . $userInfo['profile_picture'] 
    : '../../pp pics/defaultAvatar.jpg';

  $bio = !empty($userInfo['bio'])? $userInfo['bio'] : "No bio yet mate";

  $userposts_stmt = $connection->prepare('
      SELECT content, timestamp, image_path 
      FROM posts 
      WHERE user_id = ? 
      ORDER BY timestamp DESC
  ');
  $userposts_stmt->bind_param('i', $user);
  $userposts_stmt->execute();
  $result = $userposts_stmt->get_result();

  $userposts = [];
  while ($row = $result->fetch_assoc()) {
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

      $userposts[] = $row;
  }
  $userposts_stmt->close();
?>

  <?php include '../includes/navbar.php' ?>

  <!-- Profile Container -->
  <div class="profile-container">
    <div class="cover-image">
      <img src="<?= htmlspecialchars($cover_image)?>" alt="Cover"/>
    </div>

    <div class="profile-header">
      <div class="profile-picture">
       <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile Pic" />
      </div>
      <div class="user-info">
        <h2 class="display-name"><?= htmlspecialchars($userInfo['full_name']) ?></h2>
        <p class="bio"><?= htmlspecialchars($bio)?></p>
      </div>
      <div class="edit-button" title="Edit Profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#7d3cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M12 20h9" />
          <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
        </svg>
      </div>
    </div>

    <div class="tabs">
      <button class="tab active">Posts</button>
    </div>
  </div>

  <?php include '../includes/new-post-form.php'?>

  <!-- Updated Feed Section -->
  <main class="feed-container">
    <?php if (empty($userposts)): ?>
      <p>No posts yet. Start posting something!</p>
    <?php else: ?>
      <?php foreach ($userposts as $post): ?>
        <div class="post">
          <div class="post-header" style="display:flex;align-items:center;gap:10px;">
            <img src="<?= htmlspecialchars($profilePic) ?>" alt="Profile" style="width:35px;height:35px;border-radius:50%;object-fit:cover;">
            <span class="post-user"><?= htmlspecialchars($userInfo['full_name']) ?></span>
            <span class="post-time" style="margin-left:auto;font-size:12px;color:#aaa;">
              <?= htmlspecialchars($timeAgo) ?>
            </span>
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
                <img src="<?= htmlspecialchars("../uploads/" . $post['image_path']) ?>" alt="Post media" style="max-width:100%;border-radius:10px;">
              <?php elseif (in_array($ext, $videoExtensions)): ?>
                <video controls style="max-width:100%;border-radius:10px;">
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

</body>
</html>
