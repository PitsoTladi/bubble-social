<?php
include '../sql/connection.php';



$email = $_POST['email'];

$stmt = $connection->prepare("SELECT security_question FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $question = $row['security_question'];
    ?>
    <head>
        <link rel="stylesheet" href="../../frontend/styles-css/forgotpassword.css">
    </head>
    <div class = "form-container">
        <form action="verify_answer.php" method="post">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label><?php echo htmlspecialchars($question); ?></label><br>
            <input type="text" name="answer" required><br><br>
            <input type="submit" value="Submit Answer">
        </form>
    </div>

    <?php
} else {
    echo "Email not found.";
}

$connection->close();
?>
