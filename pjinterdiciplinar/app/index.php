<?php
session_start();

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
        <form action="login.php" method="post" class="form">
            <?php
                if(isset($_SESSION['error'])){
                echo "<span class='error'>" . $_SESSION['error'] . "</span>";
                }
            unset($_SESSION['error']);
            
            ?>
            <input type="text" name="user" id="user" class="input" placeholder="Insert your user">
            <button type="submit" class="btn">Login</button>
            <a href="cadastro.php">Não possui uma conta? Cadastre-se!</a>
        </form>
    </div>
</body>
</html>