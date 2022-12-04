<?php

    session_start();
    require('connect.php');

    if(!isset($_SESSION['user_logged'])){
        header('Location: index.php');
    }

try {
    $stmt = $conn->prepare("SELECT p.id, p.post, u.user FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id desc");
    $stmt->execute();
    $posts = $stmt->fetchAll();
}catch(PDOException $e){
    echo $e->getMessage();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <title>Plataforma de Debates</title>
</head>
<body>
    <div class="box-home">

    <!--CAIXA TEXTO INICIAL TOPO PAGINA-->
        <h3 class="h3">
            Olá caro internauta! <?php echo ucfirst($_SESSION['user_logged'])?>
        </h3>

    <!-- CRIAR UMA TESE -->
    <form action="post.php" method="post" class="form-post">
        <textarea name="post" id="post" class="input" placeholder="Apresente uma tese!"></textarea>
        <button type="submit" class="btn btn-post">Publicar</button>
    </form>

    
    <div class="posts">
        <div class="post">
            <!--TESTE DE POST-->
            <p class="user">Andre</p>
            <p class="text-post">POST TESE</p>

            <div class="items">
                <ul>
                    <li>
                        <form action="like.php" method="post">
                            <input type="hidden" name="post_id">
                            <button type="submit" class="btn-like">Aprovar</button>
                        </form>
                    </li>
                </ul>
            </div>

            <div>
                <p class="title-comments">Contra tese</p>
                <form action="comment.php" method="post">
                    <input type="hidden" name="post_id" value="">
                    <input type="text" name="comment" id="comment" class="comment-input" placeholder="Redija aqui sua contra tese">
                    <button type="submit" class="btn-comment">Publicar</button>
                </form>
            </div>
        </div>
        <hr>
    </div>

    </div>
</body>
</html>