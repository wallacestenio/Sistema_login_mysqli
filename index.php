<?php
include "./conn/mysqliconn.php";
include "./includes/get-ip.php";
$ip = getUserIP();
global $msg;

if(isset($_POST['btn_submit'])){

    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    if ($email != "" && $password != "" && $ip != ""){
        $sql_query = "select * from users where email='".$email."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        
        if($row){
            $plus30 = date('Y-m-d', strtotime('+30 days', strtotime($row['created_at'])));
            $data = date('Y-m-d');
            $msg = '';
            if($data > $plus30){
                $msg = "Usuário expirado";
            }elseif($ip != $row['ip']){
                $msg = "Por favor, acesse da rede ou dispositivo que realizou cadastro";
            }else{            
            $_SESSION['email'] = $email;
            header('Location: home.php');
            }
        }
        else{
            $msg = "Email e/ou Senha incorretos";
        }

    }

}
?> 
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">
    <head>
        <link rel="shortcut icon" href="assets/icone/spot.png" type="image/x-icon" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Acesso</title>

        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">        
        <script src="./assets/js/bootstrap.min.js"></script>

        <!-- Principal CSS do Bootstrap -->
        <link href="./assets/css/bootstrap.css" rel="stylesheet">        
        <!-- Principal CSS do Bootstrap -->
        <link href="./assets/css/signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
<div class="container">
    <form class="form-signin" method="post" action="">
        <div id="div_login">
            <h1>Entrar</h1>
            <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Username" />
            </div>
            <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
            </div>
            <p>
                <span  class="" style="color:red;"> <?php if(!empty($msg)){ echo $msg;}else{echo '';}  ?></span><br/>
            </p>
            <div>
                <input type="submit" value="Entrar" class="btn btn-lg btn-primary btn-block" name="btn_submit" id="btn_submit" />
            </div>
        </div>
        <br>
        <p class="mt-5 mb-3 text-muted">&copy; 2023 <a href="register.php">Registrar-me</a></p>
    </form>
</div>