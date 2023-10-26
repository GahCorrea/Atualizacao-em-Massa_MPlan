<!-- <?php
        echo "<script language='javascript'>";
        echo "alert('" . $dbcon->$ok . "');";
        //echo "window.location='Index.php';";
        echo "</script>";
        ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/PrestProf.css">
    <title>Resultado da Atualização</title>
</head>

<body>
    <div class="container">
        <div class="resBox">
            <?php
            require_once "Conexao.php";
            include_once "Funcoes.php";

            $codprest = $_GET["codPrest"];
            $crm = $_GET["crm"];
            $codprestprof = $_GET["codAma"];
            $mostraweb = $_GET["web"];
            $dbcon;

            verificaCampos($codprest, $codprestprof);

            $cons = select($dbcon, $codprest, $crm);

            $update = update($dbcon, $codprest, $crm, $codprestprof, $mostraweb);

            if (!$update) {
                echo "<script language='javascript'>";
                echo "alert('Não há dados para atualizar');";
                echo "window.location='Index.php';";
                echo "</script>";
            };

            if (!$cons) {
                echo "<script language='javascript'>";
                echo "alert('Verifique os dados digitados');";
                echo "window.location='Index.php';";
                echo "</script>";
            }

            echo "<h1>Prestadores Atualizados</h1>";
            while ($l = pg_fetch_row($cons)) {
                echo "Prestador: $l[0]";
                echo "<br>";
            }

            ?>
            <div class="back">
                <a href="./Index.php">Concluir</a>
            </div>
        </div>
    </div>
</body>

</html>