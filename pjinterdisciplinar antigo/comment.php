<?php
session_start();
require('connect.php');

try {
    $stmt->prepare("INSERT INTO comments(post_id, user_id, comment) VALUES(?,?,?)");
    $stmt->bindParam(1, $_POST['post_id'], PDO::PARAM_INT);
    $stmt->bindParam(2, $_SESSION['id_logged'], PDO::PARAM_INT);
    $stmt->bindParam(3, $_POST['comment'], PDO::PARAM_INT);

    if($stmt->execute()){
        $_SESSION['success'] = "Contra tese enviada.";
        header("Location: home.php");
    }else{
        $_SESSION['error'] = "Contra tese não enviada.";
        header("Location: home.php");
    }

}

catch(PDOException $e){
    echo $e-> getMessage();
}