<?php 
// Set a default if profile picture doesn't exist
$profilePic = !empty($currentUser['profile_picture']) 
    ? '../uploads/' . $currentUser['profile_picture'] 
    : '../../pp pics/defaultAvatar.jpg'; // use a default image
?>

<div class="new-post-container">
    <form action="../includes/post_handler.php" method="POST" enctype="multipart/form-data" class="new-post-form">
        <div class="new-post-top">
            <img src="<?= htmlspecialchars($profilePic) ?>"
                 alt="Profile Picture"
                 class="new-post-avatar" />
            
            <textarea
                name="newPostInput"
                placeholder="What's on your mind?"
                required
                class="new-post-textarea"
            ></textarea>
        </div>
        <div class="new-post-actions">
            <input type="file" name="mediaUpload" accept="image/*,video/*" class="new-post-file" />
            <button type="submit" name="newPost" value="1" class="new-post-button">Post</button>
        </div>
    </form>
</div>
<style>
    .new-post-container {
        max-width: 650px;
        margin: 80px auto 30px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .new-post-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .new-post-top {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }
    .new-post-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ccc;
    }
    .new-post-textarea {
        flex: 1;
        min-height: 100px;
        padding: 12px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 6px;
        resize: vertical;
        font-family: inherit;
    }
    .new-post-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .new-post-file {
        flex: 1;
        font-size: 14px;
    }
    .new-post-button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .new-post-button:hover {
        background-color: #45a049;
    }
</style>