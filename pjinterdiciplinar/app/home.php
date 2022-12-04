<?php

    session_start();
    require('connect.php');

    if(!isset($_SESSION['user logged'])){
        header('Location: index.php');
    }

    try{
        $stmt = $conn ->prepare("SELECT p.id, p.post, u.user FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.id desc")
        $stmt->execute();
        $posts = $stmt->fetchAll();
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
    <div class="box">
        <h3 class="h3">
            Olá caro internauta! <?php echo ucfirst($_SESSION['user_logged'])?>
        </h3>
        <?php
            if(isset($_SESSION['sucess'])){
                echo'<spam class="success">' . $_SESSION['sucess'] . '</span>';
            }

            if(isset($_SESSION['error'])){
                echo'<spam class="success">' . $_SESSION['error'] . '</span>';
            }

            unset($_SESSION['success']);
            unset($_SESSION['error']);
        ?>

    <from action="post.php" method="post" class="form-post">
        <textarea name="post" id="post" class="input" placeholder="Apresente uma tese!"></textarea>
        <button type="submit" class="btn btn-post">Publicar</button>
    </from>

    <div class="posts">
        <div class="post">
            <?php
                foreach($posts as $post){
                    $tmt = $conn->prepare("select count(*) as likes from likes where post_id = " . $post['id']);
                    $stmt->execute();
                    $likes = $stmt -> fetchAll();
            ?>
            <p class="user"><?php echo $post['user']; ?></p>
            <p class="text-post"><?php echo $post['post']; ?></p>
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
            <div>
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
</body>
</html>