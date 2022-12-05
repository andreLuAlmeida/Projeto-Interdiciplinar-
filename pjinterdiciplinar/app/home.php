<?php

    session_start();
    require('connect.php');
require('userClass.php');
    $p = new Pessoas;

    if(!isset($_SESSION['user_logged'])){
        header('Location: index.php');
    }

    try{
    $stmt = $conn->prepare("SELECT p.id, p.post, u.user FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id desc");
        $stmt->execute();
        $posts = $stmt->fetchAll();
    }catch(PDOException $e){
        echo $e->getMessage();
    }


    if((isset($_SESSION['id_logged']))){
    $id_update = $_SESSION['id_logged'];
    $res = $p->buscarDadosPessoa($id_update);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
    <title>Plataforma de Debates</title>
</head>
<body>
    <div class="box-home">
        <h3 class="h3">
            Olá caro internauta! <?php echo ucfirst($_SESSION['user_logged'])?>
        </h3>
        <?php
            if(isset($_SESSION['success'])){
                echo'<span class="success">' . $_SESSION['success'] . '</span>';
            }

            if(isset($_SESSION['error'])){
                echo'<span class="success">' . $_SESSION['error'] . '</span>';
            }

            unset($_SESSION['success']);
            unset($_SESSION['error']);
        ?>
    <!-- BOTAO PUBLICAR TESE-->
    <form action="post.php" method="post" class="form-post">
        <textarea name="post" id="post" class="input" placeholder="Apresente uma tese!"></textarea>
        <button type="submit" class="btn btn-post">Publicar</button>
    </form>

    <!-- POSTS-->
    <div class="posts">
            <?php
                foreach($posts as $post){
                    $stmt = $conn->prepare("select count(*) as likes from likes where post_id = " . $post['id']);
                    $stmt->execute();
                    $likes = $stmt -> fetchAll();
            ?>
        <div class="post">
            
            <p class="user"><?php echo $post['user']; ?></p>
            <p class="text-post"><?php echo $post['post']; ?></p>

            <!-- BOTAO APROVAR -->
            <div class="items">
                <ul>
                    <li>
                        <form action="like.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" class="btn-like">Aprovar <?php echo $likes[0]['likes']; ?></button>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- COMENTARIO-->
            <div class="comments">
                <p class="title-comments">Contra tese</p>
                <form action="comment.php" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">  
                    <input type="text" name="comment" id="comment" class="comment-input" placeholder="Redija aqui sua contra tese">
                    <button type="submit" class="btn-comment">Publicar</button>
                </form>

                <?php
                    $stmt = $conn->prepare("SELECT c.id, c.comment, u.user FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = " . $post['id'] . " ORDER BY c.id desc");
                    $stmt->execute();
                    $comments = $stmt->fetchAll();

                    foreach($comments as $comment){
                ?>
                    <div class="comment">
                        <p class="user"><?php echo $comment['user']?></p>
                        <p class="text-comment"><?php echo $comment['comment'] ?></p>
                    </div>
                    <?php
                     }
                    ?>
            </div>
        </div>
        <hr>
        <?php } ?>
    </div>

    </div>

    <div class="box-home">
        <h3 class="h3">
            Alterar perfil do <?php echo ucfirst($_SESSION['user_logged'])?>
        </h3>
        <td>
            <div action="alterar.php" method="post">
            <input type="text" id="userum" class="input" placeholder="user" value="">

            <input type="password" id="senhaum" class="input" placeholder="senha" value="">
            </div>
            <a href="home.php?id_up=<?php echo $_SESSION['id_logged'];?> ">Editar</a>
            <a href="home.php?id=<?php echo $_SESSION['id_logged'];?>">Excluir</a>
        </td>

    </div>
</body>
</html>

<?php
 if(isset($_GET['id'])){
    $id_pessoa = addslashes($_GET['id']);
    $p->excluirPessoa($id_pessoa);
    header('Location: index.php');
 }
?>