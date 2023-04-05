<?php
    // Check user login or not
if(!isset($_SESSION['email'])){
    header("Location: index.php");
}

// logout
if(isset($_POST['btn_logout'])){
    session_destroy();
    header("Location: index.php");    
    exit();
}

?>