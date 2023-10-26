<?php
$conn_string = "host=187.50.93.146 port= dbname= user= password=";

$dbcon = pg_connect($conn_string);

if (!$dbcon) {
    return die("Conexão Falhou!");
}
