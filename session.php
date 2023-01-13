<?php
    session_start();
    if(!isset($_SESSION['id'])){              
      header('location: login.php');
    }
    else{
      echo "<div class='d-flex justify-content-between'><p>Hi, " . $_SESSION['username'] . "</p>
        <a href='config/logout.php' class='text-dark text-decoration-none'>Logout ➦</a></div><hr>";
    }
    
?>
    


