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

        public function excluirPessoa($id)
        {
            require('connect.php');

            $cmd = $conn->prepare("DELETE FROM comments where user_id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $cmd = $conn->prepare("DELETE FROM likes where user_id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $cmd = $conn->prepare("DELETE FROM posts where user_id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $cmd = $conn->prepare("DELETE FROM users where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        }

        public function buscarDadosPessoa($id){
            require('connect.php');

        $res = array();
            $cmd = $conn->prepare("SELECT * FROM users where id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
        }

        public function atualizarDadosPessoa($id, $user, $senha){
        require('connect.php');

            $cmd = $conn->prepare("UPDATE users SET user = :u, senha = :s WHERE id = :id");
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":u", $user);
            $cmd->bindValue(":s", $senha);
        $cmd->execute();
    
        }
    }
?>