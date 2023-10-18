<?php

if(isset($_POST['username']) && isset($_POST['password1'])) {

    $username = $_POST['username'];
    $password1 = $_POST['password1'];

    require 'db.php';
       
        $sql= "SELECT * FROM users WHERE user_name = ?;";
        $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: login.php?error=statementfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($resultData);
              
            $user_id = $row['id'];
            $user_name = $row['user_name'];
            $user_password = $row['password'];

            $checkPwd = password_verify($password1, $user_password);

            if($username === $user_name) {
                if($checkPwd === true) {

                    session_start(); 
                    // $_SESSION["id"] = $id;
                    $_SESSION["user_name"] = $user_name;
                    $_SESSION["password"] = $password;

                    header("location: admin.php?succ=#");
                    exit();

                }else {
                    header("location: login.php?error=Incorrect Password");
                }

            }else {
            header("location: login.php?error=Incorrect Username");
            }

            mysqli_stmt_close($stmt);

    } 
    
    else {
    header("location: login.php");
}
