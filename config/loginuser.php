<?php

session_start();
require 'dbconnect.php';

$username = $_POST['username'];
$password = $_POST['password'];

if($password != '' && $username != ""){

    $sql = "SELECT id, username, password FROM users WHERE username = '{$username}';";
    $result = $conn->query($sql);    

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password'] )){
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('location: ../contacts.php');
        }else{
            $_SESSION['error'] = "Credentials do not match!";
            header('location: ../login.php');
        }
    }
    else{        
        $_SESSION['error'] = "User not found.";
        header('location: ../login.php');
    }    

}else{
    $_SESSION['error'] = "Some fields are empty!";
    header('location: ../login.php');
}

?>  