<?php 

$user = addslashes($_POST['userum']);
                $senha = addslashes($_POST['senhaum']);
                if(!empty($user) && !empty($senha)){

    $id_update = addslashes($_SESSION['id_logged']);


    $p->atualizarDadosPessoa($id_update, $user, $senha);
                    echo "Atualizar, volte para pagina de login";
                    echo '<a href="login.php"> Voltar </a>';
        
                }
                else
                {
                echo "Preencha todos os campos";
                }