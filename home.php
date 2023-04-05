<?php
include "./conn/mysqliconn.php";

// Check user login or not
if(!isset($_SESSION['email'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['btn_logout'])){
    session_destroy();
    header('Location: index.php');
}
include "./includes/head.php";
echo $pageName = '<h1>Página Inicial</h1>';
?>

        <form method='post' action="" class="form-control">
            <input type="submit" value="Sair" name="btn_logout">
        </form>
        <?php
        include "./includes/footer.php";
    