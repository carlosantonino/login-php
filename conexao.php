<?php 
    $host = "localhost";
    $user = "carlosc";
    $pass = "6j@fbWtFQ0cJk3sV";
    $dbname = "celke";

    try {
        // Conexão 
        $conn = new PDO("mysql:host=$host;dbname=" . $dbname, $user, $pass);
        // echo "Conexão realizada com sucesso";
    } catch (PDOException $err) {
        // echo "Erro: Não conseguiu realizar a conexão";
    }