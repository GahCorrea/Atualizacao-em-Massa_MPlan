<?php
function verificaCampos($codprest, $codprestprof)
{

    if (empty($codprest) && empty($codprestprof)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Prestador e Cód. Amarração não podem ser VAZIOS');";
        echo "window.location='Index.php';";
        echo "</script>";
    } else if (empty($codprestprof)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Amarração não pode ser VAZIO');";
        echo "window.location='Index.php';";
        echo "</script>";
    } else if (empty($codprest)) {
        echo "<script language='javascript'>";
        echo "alert('Cód. Prestador não pode ser VAZIO');";
        echo "window.location='Index.php';";
        echo "</script>";
    }
}

function update($dbcon, $codprest, $crm, $codprestprof, $mostraweb)
{
    
    if (empty($crm)) {
        return pg_query($dbcon, "update prestprof set codprestprof = '$codprestprof', mostraweb = '$mostraweb' where codprest = '$codprest' and (codprestprof is null or codprestprof = '')");
    }else {
        return pg_query($dbcon, "update prestprof set codprestprof = '$codprestprof', mostraweb = '$mostraweb' where codprest = '$codprest' and numconselhoprof = '$crm' and (codprestprof is null or codprestprof = '')");
    }
}

function select($dbcon, $codprest, $crm)
{
    if (empty($crm)) {
        return pg_query($dbcon, "select nomeprof from prestprof where codprest = '$codprest' and (codprestprof is null or codprestprof = '') order by nomeprof");
    }else {
        return pg_query($dbcon, "select nomeprof from prestprof where codprest = '$codprest' and numconselhoprof = '$crm' and (codprestprof is null or codprestprof = '') order by nomeprof");
    }
}
