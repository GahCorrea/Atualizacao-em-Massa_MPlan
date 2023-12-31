<?php
session_start();
ob_start();

include_once "Funcoes.php";

if (!validaToken()) {
    $_SESSION['msg'] = "<h1 style='color: #f00;'>ERRO: Necessário Realizar o Login para Acessar a Página!</h1>";

    header("Location: Index.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/Home.css">
    <link rel="shortcut icon" href="./Image/favicon.ico" type="image/x-icon">
    <title>Upload em Massa</title>
</head>

<body>
    <div class="container">
        <div class="pesBox">
            <h3>Atualização de <i>PrestProf</i></h3>
            <form action="PrestProf.php" method="post">
                <h4>Cód. Prestador</h4>
                <input type="text" name="codPrest" placeholder="Ex: 000148" class="prest">
                <h4>CRM</h4>
                <input type="text" name="crm" placeholder="Ex: 995368" class="prest">
                <h4>Cód. Amarração</h4>
                <input type="text" name="codAma" placeholder="Ex: 000125" class="prest">
                <div class="web">
                    <input type="checkbox" name="web" id="web" value="1" checked><label for="web">Mostra Web</label>
                </div>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>
</body>

</html>