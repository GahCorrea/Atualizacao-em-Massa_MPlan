<?php
$host = "187.50.93.146";
$port = "5441";
$dbname = "Plano_Amhe";
$user = "WARELINE";
$password = "BENEF";

try {
    $dbcon = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password");
} catch (PDOException $err) {
    echo "Erro: Conexão com banco de dados falhou (Erro: " . $err->getMessage();
}
