<?php
include '../sql/connection.sql';

$sql = 'SELECT * FROM POSTS WHERE user_id =   '

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../../frontend/styles-css/user-profile.css" />
    <title><?php echo htmlspecialchars($user['name']); ?>'s Profile</title>
</head>
<body>
    <section class="background-image"></section>

    <section class="profile-section">
        <img src="<?php echo $user['profile_pic']; ?>" alt="Profile Picture" /><br />
        <h1><?php echo htmlspecialchars($user['name']); ?></h1>

        <section class="bio section">
            <h2>About</h2>
            <p><?php echo htmlspecialchars($user['bio']); ?></p>
        </section>

        <button class="Follow">Follow</button>
        <button class="message">Message</button>
    </section>

    <section class="photos-posts-section">
        <div class="photos">
            <h2>Photos</h2>
            <div class="photo-gallery">
                <?php foreach ($photos as $photo): ?>
                    <img
                        src="<?php echo htmlspecialchars($photo['url']); ?>"
                        alt="<?php echo htmlspecialchars($photo['alt']); ?>"
                    />
                <?php endforeach; ?>
            </div>
        </div>

        <div class="posts">
            <h2>Posts</h2>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
