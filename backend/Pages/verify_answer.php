<?php
include '../sql/connection.php';

$email = $_POST['email'];
$answer = $_POST['answer'];

$stmt = $connection->prepare("SELECT * FROM users WHERE email = ? AND security_answer = ?");
$stmt->bind_param("ss", $email, $answer);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Show password reset form
    ?>
    
    <?php
} else {
    echo "Incorrect answer.";
}

$connection->close();
?>

<html>
    <head>
        <link rel="stylesheet" href="../../frontend/styles-css/forgotpassword.css">
    </head>

    <div class= 'form-container'>
        <form action="reset_password.php" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label>New Password:</label><br>
            <input type="password" name="new_password" required><br><br>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</html>