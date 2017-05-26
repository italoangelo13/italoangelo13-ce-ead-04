<?php

require_once("conecta_mysql.inc.php");
session_start();
if (isset($_SESSION['logado'])) {
    if ($_SESSION['adm'] == TRUE) {
        $nome = $_SESSION['nome'];
    } else {
        header("Location: index.html");
    }
} else {
    header("Location: index.html");
}

$codigo = $_REQUEST[id];

$sqlDelete = "DELETE FROM LIVROS WHERE codigo = $codigo";
$resultado = $mysqli->query($sqlDelete);
if ($resultado){
    header("Location: produtos.php");
}