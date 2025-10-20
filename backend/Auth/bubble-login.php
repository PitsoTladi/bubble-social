<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../frontend/styles-css/styling.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <title>bubble social media</title>
</head>
<body>
    <div class="login">
        <form method="POST">
            <div class="thought-bubble-container" title="Bubble">
                <div class="thought-bubble-icon">&#128172;</div>
                <span>bubble</span>
            </div>

            <input type="email" required placeholder="Email" name="email"><br>
            <input type="password" required placeholder="Password" name="password"><br>

            <!-- Error display -->
            <p style="color: red;"><?php if (!empty($error_message)) echo htmlspecialchars($error_message); ?></p>

            <a href="#">Forgot Password</a><br>
            <button type="submit" name="login">Login</button>
            <div class="hr-text">OR</div>
            <a href="bubble.php">Create Account</a>
        </form>
    </div>

    <?php
    session_start();
    
// If the user is already logged in, redirect to profile
if (isset($_SESSION['user_id'])) {
    header("Location: ../pages/user-profile.php");
    exit;
}
    include '../sql/connection.php';

    $error_message = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $password = mysqli_real_escape_string($connection, $_POST['password']);

        $sql = "SELECT id, password_hash FROM users WHERE email = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password_hash'])) {
                // Security: Regenerate session ID to prevent fixation
                session_regenerate_id(true);

                // Store user ID in session
                $_SESSION['user_id'] = $user['id'];

                // Redirect to profile
                header("Location: ../pages/user-profile.php");
                exit;
            } else {
                $error_message = "Incorrect password.";
            }
        } else {
            $error_message = "User does not exist.";
        }

        $stmt->close();
        $connection->close();
    }
    ?>
</body>
</html>
