<?php

session_start();
require('connect.php');
try{
    $stmt = $conn->prepare("SELECT id, user FROM users WHERE user = '" . $_POST['user'] . "'");
    $stmt->execute();
    $user = $stmt->fetchAll()[0];

    if($user){
        $_SESSION['user_logged'] = $user['user'];
        $_SESSION['id_logged'] = $user['id'];
        header("Location: home.php");
    }
    else
    {
        unset($_SESSION['user_logged']);
        unset($_SESSION['id_logged']);
        $_SESSION['error'] = "Usuário inválido";
        header("Location: index.php");

    }
}catch(PDOException $e){
    echo $e->getMessage();
}