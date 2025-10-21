<?php
    include '../sql/connection.php';
    include '../Auth/session.php';
    
    if(isset($_POST['delete'])){
        $user = $_SESSION['user_id'];
        

        $stmt = $connection -> prepare('DELETE FROM users where id = ?');

        if($stmt){
            $stmt -> bind_param('i', $user);

            if($stmt -> execute()){
                session_destroy();
                header('location: ../auth/bubble.php');
                exit();
            }
            $stmt -> close();
        }
        
        $connection ->close();
    }

    if(isset($_POST['cancel'])){
        header('Location:settings-Page.php');
        exit();
    }
?>

<html>
   
   
</html>