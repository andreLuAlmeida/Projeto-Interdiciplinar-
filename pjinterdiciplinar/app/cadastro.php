<?php
session_start();
include('userClass.php');
$p = new Pessoas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;700&display=swap" rel="stylesheet">

    <title>Social Academy</title>
</head>
<body>
    <div class="box">
        <h2 class="h2">
            Social Academy
        </h2>

        <?php

            if(isset($_POST['user']))
            {
                $user = addslashes($_POST['user']);
                $senha = addslashes($_POST['senha']);
                if(!empty($user) && !empty($senha)){

                if($p->cadastrarPessoa($user, $senha)){
                    echo "Cadastro bem sucedido, volte para pagina de login";
                    echo '<a href="login.php"> Voltar </a>';
                }
                else{
                    echo "Email ja cadastrado";
                }

                }
                else
                {
                echo "Preencha todos os campos";
                }
            }

        ?>
        <form method="post" class="form">
            <?php
                if(isset($_SESSION['error'])){
                echo "<span class='error'>" . $_SESSION['error'] . "</span>";
                }
            unset($_SESSION['error']);
            
            ?>
            <input type="text" name="user" id="user" class="input" placeholder="Insert seu usuario">
            <input type="password" name="senha" id="senha" class="input" placeholder="Insira sua senha">
            <button type="submit" class="btn">Cadastrar</button>
            <a href="index.php">Já possui uma conta? Entre!</a>
        </form>
    </div>
</body>
</html>