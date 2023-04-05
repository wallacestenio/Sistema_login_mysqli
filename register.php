<?php
include "./conn/mysqliconn.php";
include "./includes/get-ip.php";

$ip = getUserIP();
$data = date('Y-m-d');

if(isset($_POST['btn_submit'])){

    $name = mysqli_real_escape_string($con,addslashes($_POST['name']));    
    $email = mysqli_real_escape_string($con,addslashes($_POST['email']));
    $password = mysqli_real_escape_string($con,addslashes(sha1($_POST['password'])));
    $confPassword = mysqli_real_escape_string($con,addslashes(sha1($_POST['confPassword'])));

    if ($email != "" && $password != "" && $confPassword != "" && $ip != "" && $data != ""){
        $sql_query = "select * from users where email='".$email."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);
        
        if($row){
            /*
            $plus30 = date('Y-m-d', strtotime('+30 days', strtotime($row['created_at'])));
           
            $msg = '';
            if($data > $plus30){
                $msg = "Usuário expirado";
            }elseif($ip != $row['ip']){
                $msg = "Por favor, acesse da rede ou dispositivo que realizou cadastro";
            }else{            
            $_SESSION['email'] = $email;
            header('Location: home.php');
            }*/
            $msg = "Email já está cadastrado";
        }
        else{
            if($password != $confPassword){
            $msg = "As senhas estão diferentes";
            }else{
                
                $sql = "INSERT INTO users (name, email, password, ip, created_at) VALUES ('$name', '$email', '$password','$ip','$data')";
                if (mysqli_query($con, $sql)) {
                      $msg = "Registro realizado com sucesso!";
                } else {
                       $msg = "Error: " . $sql . "<br>" . mysqli_error($con);
                }
                mysqli_close($con);
            }
            
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
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">        
        <script src="./assets/js/bootstrap.min.js"></script>
        <title>Novo Cadastro</title>
        <!-- Principal CSS do Bootstrap -->
        <link href="./assets/css/bootstrap.css" rel="stylesheet">        
        <!-- Principal CSS do Bootstrap -->
        <link href="./assets/css/signin.css" rel="stylesheet">
    </head>
    <body class="text-center">
<div class="container">
    <form class="form-signin" method="post" action="">
        <div id="div_login">
            <h1>Novo Cadastro</h1>
            <br>
            <div>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome" autofocus/>
            </div>
            <div>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" />
            </div>
            <div>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha"/>
            </div>
            <div>
                <input type="password" class="form-control" id="password" name="confPassword" placeholder="Confirma Senha"/>
            </div>
            <p>
                <span  class="" style="color:red;"> <?php if(!empty($msg)){ echo $msg;}else{echo '';}  ?></span><br/>
            </p>
            <div>
                <input type="submit" value="Cadastrar" class="btn btn-lg btn-success btn-block" name="btn_submit" id="btn_submit" />
            </div>
        </div>
        <br>
        <p class="mt-5 mb-3 text-muted">&copy; 2023 <a href="index.php">Já possuo cadastro</a></p>
    </form>
</div>