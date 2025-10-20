<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create a Post</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<?php if (!empty($message)): ?>
  <div class="alert">
    <?= htmlspecialchars($message) ?>
  </div>
<?php endif; ?>

<form action="../includes/post_handler.php" method="POST" enctype="multipart/form-data">
  <div class="new-post">
    <section class="new-post-section">
      <img src="<?= htmlspecialchars(!empty($currentUser['profile_picture']) ? "../uploads/" . $currentUser['profile_picture'] : './../../pp pics/default-avatar.png') ?>" 
           alt="Profile Image" id="profile-image" />
      <input type="text" name="newPostInput" id="newPostInput" placeholder="What's on your mind?" required />
      <input type="file" name="mediaUpload" id="mediaUpload" accept="image/*,video/*" />
      <label for="mediaUpload" class="attachment" title="Upload pic or video">&#x1F517;</label>
      <button type="submit" name="newPost" value="1" id="postButton">Post</button>
    </section>
  </div>
</form>

</body>
</html>