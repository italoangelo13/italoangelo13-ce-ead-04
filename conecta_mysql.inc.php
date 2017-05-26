<?php
$server = "localhost";
$user = "root";
$psw = "";
$bd = "loja";

$mysqli = new mysqli($server,$user,$psw,$bd);
mysqli_set_charset($mysqli,"utf8");
?>