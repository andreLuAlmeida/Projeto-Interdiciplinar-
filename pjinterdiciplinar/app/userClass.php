<?php

    Class Pessoas{

        function __constructor(){

        } 
        public function cadastrarPessoa($user, $senha)
        {
        require('connect.php');
        $cmd = $conn->prepare("SELECT id FROM users WHERE user = :e");
        $cmd->bindValue(":e", $user);
        $cmd->execute();
        if($cmd->rowCount()>0){
            return false;
        }else{
            $cmd = $conn->prepare("INSERT INTO users (user, senha) VALUES (:u, :s)");
            $cmd->bindValue(":u", $user);
            $cmd->bindValue(":s", $senha);
            $cmd->execute();
            return true;
        }
        }
    }
?>