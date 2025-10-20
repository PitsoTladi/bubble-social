<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../../frontend/styles-css/styling.css" />
    <title>Bubble Social Media</title>
</head>
<body>
<?php

include '../sql/connection.php';


$field = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $security_q = $_POST['security'];
    $security_a = $_POST['answer'];
    $ppic = $_FILES['p-pic'];

    
    $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $field = "Email has already been used.";
    } elseif ($password !== $password_confirm) {
        $field = "*Passwords don't match.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $ppic_name = '';
        if ($ppic['error'] === UPLOAD_ERR_OK) {
            $target_dir = "../uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            $ppic_name = basename($ppic["name"]);
            $target_file = $target_dir . $ppic_name;
            move_uploaded_file($ppic["tmp_name"], $target_file);
        }

     
        $insert_stmt = $connection->prepare("INSERT INTO users (full_name, email, password_hash, profile_picture,security_question,security_answer) VALUES (?,?,?, ?, ?, ?)");
        $insert_stmt->bind_param('ssssss', $fname, $email, $password_hash, $ppic_name, $security_q, $security_a);


        if ($insert_stmt->execute()) {
            
            echo '<h1 style="color: green;">we in baaaaaby</h1>';
            header("Location: ../pages/bubble-welcome.php");


        
        } else {
            $field = "Error creating account: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    

    $stmt->close();
    $connection->close();
}
?>

<div class="login" id="sign-up_form">
    <form method="post" enctype="multipart/form-data" action = ''>
        <div class="thought-bubble-container" title="Bubble">
            <div class="thought-bubble-icon">&#128172;</div>
            <span>bubble</span>
        </div>

        <input type="text" required placeholder="Full name" name="fname" /><br />
        <input type="email" required placeholder="Email" name="email" /><br />
        <input type="password" required placeholder="Password" name="password" /><br />
        <input type="password" required placeholder="Confirm Password" name="password_confirm" /><br />

        <p style="color: red;"><?php if (!empty($field)) echo htmlspecialchars($field); ?></p>
        
        <label >security question</label>
        <select name="security" id="">
            <option value="City of birth">Where were you born?</option>
            <option value="favourite colour">Whats your favorite colour?</option>
            <option value="favourite team">Whats your favorite sports team?</option>
        </select><br>
        <input type="text" name = 'answer' placeholder='security question answer' required><br>

        <label>Profile image (optional):</label>
        <input type="file" accept="image/*" name="p-pic" /><br />


        <button type="submit">Sign up</button>
        <div class="hr-text">Already Have An Account?</div>
        <a href="bubble-login.php">Login</a>
    </form>
</div>
</body>
</html>
