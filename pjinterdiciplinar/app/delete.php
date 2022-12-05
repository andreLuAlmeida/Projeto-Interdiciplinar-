<?php
try {
    if (isset($_SESSION['id_logged'])) {
        $p->excluirPessoa($_SESSION['id_logged']);
        header('index.php');
    }
}
catch(Exception $e){
    echo $e->getMessage(); 
}
?>