<?php
function verificarCampos($codprest, $codprestprof)
{

    if (empty($codprest) && empty($codprestprof)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Prestador e Cód. Amarração não podem ser VAZIOS');";
        echo "window.location='Home.php';";
        echo "</script>";
    } else if (empty($codprestprof)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Amarração não pode ser VAZIO');";
        echo "window.location='Home.php';";
        echo "</script>";
    } else if (empty($codprest)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Prestador não pode ser VAZIO');";
        echo "window.location='Home.php';";
        echo "</script>";
    }
}

function listaPrestador($dbcon, $codprest, $crm)
{
    if (empty($crm)) {
        $query = "select nomeprof from prestprof where codprest = '$codprest' and (codprestprof is null or codprestprof = '') order by nomeprof";

        $result = $dbcon->prepare($query);

        $result->execute();

        return $result;
    } else {
        $query = "select nomeprof from prestprof where codprest = '$codprest' and numconselhoprof = '$crm' and (codprestprof is null or codprestprof = '') order by nomeprof";

        $result = $dbcon->prepare($query);

        $result->execute();

        return $result;
    }
}

function salvarPrestador($dbcon, $codprest, $crm, $codprestprof, $mostraweb)
{

    if (empty($crm)) {
        $query = "update prestprof set codprestprof = '$codprestprof', mostraweb = '$mostraweb' where codprest = '$codprest' and (codprestprof is null or codprestprof = '')";

        $result = $dbcon->prepare($query);

        $result->execute();
    } else {
        $query = "update prestprof set codprestprof = '$codprestprof', mostraweb = '$mostraweb' where codprest = '$codprest' and numconselhoprof = '$crm' and (codprestprof is null or codprestprof = '')";

        $result = $dbcon->prepare($query);

        $result->execute();
    }
}

function validaToken()
{
    $token = $_COOKIE['token'];

    $token_array = explode('.', $token);

    $header = $token_array[0];
    $payload = $token_array[1];
    $signature = $token_array[2];

    $key = "DGBU85S46H9M5W4X6OD7";

    $validar_ass = hash_hmac('sha256', "$header.$payload", $key, true);

    $validar_ass = base64_encode($validar_ass);

    if ($signature == $validar_ass) {
        $dados_token = base64_decode($payload);

        $dados_token = json_decode($dados_token);

        if ($dados_token->exp > time()) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
