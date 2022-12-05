<?php

session_start();
require('connect.php');
try{
    $stmt = $conn->prepare("SELECT id, user FROM users WHERE user = '" . $_POST['user'] . "'");
    $stmt->execute();
    $user = $stmt->fetchAll()[0];

    $stmtTwo = $conn->prepare("SELECT id, senha FROM users WHERE senha = '" . $_POST['senha'] . "'");
    $stmtTwo->execute();
    $userTwo = $stmtTwo->fetchAll()[0];

    if($user && $userTwo){
        $_SESSION['user_logged'] = $user['user'];
        $_SESSION['id_logged'] = $user['id'];
        header("Location: home.php");
    }
    else
    {
        unset($_SESSION['user_logged']);
        unset($_SESSION['id_logged']);
        $_SESSION['error'] = "Usuário ou senha inválidos";
        header("Location: index.php");

    }
}catch(PDOException $e){
    echo $e->getMessage();
}