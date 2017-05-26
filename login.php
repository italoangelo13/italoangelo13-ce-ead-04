<?php
require_once("conecta_mysql.inc.php");
$loginInfo = $_REQUEST['login'];
$senhaInfo = $_REQUEST['senha'];
$adm = $_REQUEST['adm'] ?? "off";
$sql = "";
$msg = "";
$url = "";
if ($adm == "on") {
    $sql = "SELECT usuario, senha, nome FROM admins where usuario = '" . $loginInfo . "'";
} else {
    $sql = "SELECT usuario, senha, nome FROM clientes where usuario = '" . $loginInfo . "'";
}

$resultado = $mysqli->query($sql);
if ($mysqli->affected_rows > 0) {
    while ($dados = $resultado->fetch_assoc()) {
        $loginbd = $dados['usuario'];
        $senhabd = $dados['senha'];
        $nome = $dados['nome'];
    }
} else {
    $loginbd = "nada";
    $senhabd = "nada";
    $nome = "nada";
}


if ($loginInfo == $loginbd) {
    if ($senhaInfo == $senhabd) {
        if ($adm == "on") {
            $msg = "Login Realizado com sucesso, Aguarde o redirecionamento da Página!";
            $url = '<meta http-equiv="refresh" content=3;url="admin.php">';
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['adm'] = true;
            $_SESSION['login'] = $loginbd;
            $_SESSION['nome'] = $nome;
        } else {
            $msg = "Login Realizado com sucesso, Aguarde o redirecionamento da Página!";
            $url = '<meta http-equiv="refresh" content=3;url="loja.php">';
            session_start();
            $_SESSION['logado'] = true;
            $_SESSION['adm'] = false;
            $_SESSION['login'] = $loginbd;
            $_SESSION['nome'] = $nome;
        }
    } else {
        $msg = "Login ou Senha Incorretos, Tente Novamente!";
        $url = '<meta http-equiv="refresh" content=3;url="index.html">';
    }
} else {
    $msg = "Login ou Senha Incorretos, Tente Novamente!";
    $url = '<meta http-equiv="refresh" content=3;url="index.html">';
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livraria do Italo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="jumbotron jumbotron-fluid col-lg-12 estilo-header" >
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <h1 class="display-1">Livraria do Italo</h1>
                                    <p class="lead">Aqui voce encontra os Melhores Livros pelos menores preços!</p>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="display-5 alert alert-info"><center><?php echo $msg; ?></center></h1>
                    <?php echo $url; ?>
                </div>
            </div>


            <footer class="row footer">
                <div class="col-lg-12 estilo-footer">
                    <center><h1>@Livrariadoitalo</h1></center>
                </div>
            </footer>

        </div>




        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
