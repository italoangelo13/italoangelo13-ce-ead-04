<?php

error_reporting(0);
session_start();
require_once("conecta_mysql.inc.php");
$msg = "";
$url = "";

// verifica se o usuario esta logado
if (isset($_SESSION['logado'])) {
    if ($_SESSION['adm'] == TRUE) {
        $nome = $_SESSION['nome'];
    } else {
        $nome = $_SESSION['nome'];
    }
} else {
    header("Location: index.html");
}


if (!isset($_SESSION['carrinho'])) {
    $msg = "Voce não Possui um carrinho de Compras.";
    $url = "loja.php";
}


foreach ($_SESSION[carrinho] as $cod => $quant) {
    $codC = $_SESSION['carrinho'][$cod]['codigo'];
    $quantC = $_SESSION['carrinho'][$cod]['quantidade'];
    $sql = "SELECT qtde FROM livros where codigo = $codC";
    $resultado = $mysqli->query($sqlLivros);
?>