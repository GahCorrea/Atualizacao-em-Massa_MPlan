<?php
$host = "";
$port = "";
$dbname = "";
$user = "";
$password = "";

try {
    $dbcon = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
} catch (PDOException $err) {
    echo "Erro: Conexão com banco de dados falhou (Erro: " . $err->getMessage();
}
