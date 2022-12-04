<?php
session_start();
require('connect.php');

try {
    $stmt = $conn->prepare("INSERT INTO posts(post, user_id) VALUES(?,?)");
    $stmt->bindParam(1, $_POST['post'], PDO::PARAM_STR);
    $stmt->bindParam(2, $_SESSION['id_logged'], PDO::PARAM_INT);

    if($stmt->execute()){
        $_SESSION['success'] = "Tese enviada.";
        header("Location: home.php");
    }else{
        $_SESSION['error'] = "Tese não enviada.";
        header("Location: home.php");
    }

}

catch(PDOException $e){
    echo $e-> getMessage();
}