<?php

try {
    $conn = new PDO("mysql:host=34.95.255.211;dbname=social-academy", "root", "mTrkYfFVV:9vGz{e");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException) {
    echo "Erro com banco de dados: " . $e->getMessage();
}
catch(Exception $e){
    echo "Erro generico: " . $e->getMessage();
}
