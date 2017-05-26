<?php
require_once './conecta_mysql.inc.php';
require_once './config_upload.inc.php';


$titulo = $_REQUEST['titulo'];
$autor = $_REQUEST['autor'];
$categoria = $_REQUEST['categoria'];
$quantidade = $_REQUEST['quantidade'];
$preco = $_REQUEST['preco'];
set_time_limit(60);
$nomeImg  = $_FILES['img']['name'];
$tamanhoImg = $_FILES['img']['size'];
$temp_name = $_FILES['img']['tmp_name'];
$extImg = strrchr($nomeImg, '.');
file_exists("$diretorio/$nomeImg");
!in_array($extImg, $extensoes_validas);
move_uploaded_file($temp_name, "$diretorio/$nomeImg");
$img = $diretorio.$nomeImg;


//Query de inserção no banco.
$sqlInsereLivro = "INSERT INTO LIVROS (categoria,titulo,autor,preco,imagem,qtde) VALUES ('$categoria', '$titulo', '$autor','$preco', '$img', '$quantidade')";
$resultado = $mysqli->query($sqlInsereLivro);
if($resultado){
    header("Location: produtos.php");
}
?>