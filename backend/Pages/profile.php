<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profile Page</title>
  <link rel="stylesheet" href="../../frontend/styles-css/profile-styles.css" />
</head>
<body>
  <?php include '../includes/navbar.php' ?>
  <!-- Profile Container -->
  <div class="profile-container">
    <!-- Cover Image -->
    <div class="cover-image">
      <img
        src="../../pp pics/download.jpg"
        alt="Cover"
      />
    </div>

    <!-- Profile Header -->
    <div class="profile-header">
      <div class="profile-picture">
        <img
          src="../../pp pics/Colonel Nathan R_ Jessup - 'A Few Good Men'.jpg"
          alt="Profile Pic"
        />
      </div>
      <div class="user-info">
        <h2 class="display-name">Jane Doe</h2>
        <p class="bio">Web developer. Dreamer. Purple enthusiast 💜</p>
      </div>
      <div class="edit-button" title="Edit Profile">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="#7d3cff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
          <path d="M12 20h9" />
          <path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4 12.5-12.5z" />
        </svg>
      </div>
    </div>

    <?php include '../includes/new-post-form.php';?>

    <!-- Content Tabs -->
    <div class="tabs">
      <button class="tab active">Posts</button>
    </div>
  </div>

  <!-- Feed Container (Separate) -->
  <div class="feed-container">
    <div class="main-feed">
      <div class="post">
        <h3>Post Title 1</h3>
        <p>This is the content of the first post.</p>
      </div>
      <div class="post">
        <h3>Post Title 2</h3>
        <p>Another interesting post goes here.</p>
      </div>
    </div>
  </div>
</body>
</html>