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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/PrestProf.css">
    <link rel="shortcut icon" href="./Image/favicon.ico" type="image/x-icon">
    <title>Resultado da Atualização</title>
</head>

<body>
    <div class="container">
        <div class="resBox">
            <h5>Prestadores Atualizados</h5>
            <?php
            include_once "Conexao.php";

            $codprest = $_POST["codPrest"];
            $crm = $_POST["crm"];
            $codprestprof = $_POST["codAma"];
            $mostraweb = $_POST["web"];
            $dbcon;

            verificarCampos($codprest, $codprestprof);

            $result_select = listaPrestador($dbcon, $codprest, $crm);

            // if (!$update) {
            //     echo "<script language='javascript'>";
            //     echo "alert('Não há dados para atualizar');";
            //     echo "window.location='Home.php';";
            //     echo "</script>";
            // };

            if (($result_select) and ($result_select->rowCount() != 0)) {
                $rows = $result_select->fetchAll();

                foreach ($rows as $row) {
                    echo "Prestador: $row[0]";
                    echo "<br>";
                }

                salvarPrestador($dbcon, $codprest, $crm, $codprestprof, $mostraweb);
            } else {
                echo "<script language='javascript'>";
                echo "alert('Prestador já atualizado ou Dados incorretos!');";
                echo "window.location='Home.php';";
                echo "</script>";
            }
            ?>
            <div class="back">
                <a href="./Home.php">Concluir</a>
            </div>
        </div>
    </div>
</body>

</html>