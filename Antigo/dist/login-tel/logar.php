<?php

if (isset($_POST['imal']) && !empty($_POST['imal']) && isset($_POST['sinha']) && !empty($_POST['sinha'])) {

    require_once 'classeUser.php';
    $pes = new Pessoa("rede-social", "localhost", "root", "");

    
    $login = addslashes($_POST['imal']);
    $senha = addslashes($_POST['sinha']);

    if($pes->login($login, $senha)){
        if(isset($_SESSION['idUser'])){
            header("Location: ../feed/index.php");
        }
    }else{
        header("Location: index.php");
    }   
}else{
    
    header("Location: index.php");
}
?>