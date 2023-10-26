<?php
$conn_string = "host=187.50.93.146 port=5441 dbname=Plano_Amhe user=WARELINE password=BENEF";

$dbcon = pg_connect($conn_string);

if (!$dbcon) {
    return die("Conexão Falhou!");
}
