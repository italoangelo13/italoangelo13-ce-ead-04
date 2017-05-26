<?php  
	session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['adm'] == TRUE){
            $nome = $_SESSION['nome'];
        }
        else{
            header("Location: index.html");
        }
    }
    else{
        header("Location: index.html");
    }

    // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
    // CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
    $dataLocal = date('d/m/Y');
    $horaLocal = date('H:i:s', time());

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livraria do Italo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilo.css" />
    </head>
    <body>
        <div class="container-fluid">
        	<div class="row">
                <div class="jumbotron jumbotron-fluid col-lg-12 estilo-header" >
                  <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <center>
                                <h1 class="display-1">Livraria do Italo</h1>
                                <p class="lead">Aqui voce encontra os Melhores Livros pelos menores preços!</p>
                           </center>
                        </div>

                        <div class="col-lg-2">
                            <center><a href="logout.php" style="color: #fff; text-decoration: none;"> <img src="imagens/logout.ico" alt="Sair" width="70%" /> </a></center>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10">
                            <center><h4>Olá, <?php echo $nome; ?>!</h4></center>
                        </div>

                        <div class="col-lg-2">
                            <center><h6><?php echo $dataLocal; ?> <br> <?php echo $horaLocal; ?></h6></center>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="card col-lg-3 bloco">
                    <a href="loja.php"><center><img class="card-img-top" src="imagens/loja.png" alt="Loja Online" width="95%"></center>
                  <div class="card-block caixa-texto">
                      <p class="card-text texto">Loja Online</p>
                  </div></a>
                    </div>
                
                
                <div class="card col-lg-3 bloco">
                    <a href="produtos.php" /><center><img class="card-img-top" src="imagens/livro.png" alt="Gerenciar Produtos" width="95%"></center>
                  <div class="card-block caixa-texto">
                      <p class="card-text texto">Gerenciar Livros</p>
                  </div>
                </div>
                
                <div class="card col-lg-3 bloco">
                    <a href="usuarios.php" /><center><img class="card-img-top" src="imagens/usuario.png" alt="Gerenciar usuarios" width="95%"></center>
                  <div class="card-block caixa-texto">
                      <p class="card-text texto">Gerenciar Usuarios</p>
                  </div>
                </div>
                
                <div class="card col-lg-3 bloco">
                    <a href="clientes.php" /><center><img class="card-img-top" src="imagens/cliente.png" alt="Gerenciar Clientes" width="95%"></center>
                  <div class="card-block caixa-texto">
                      <p class="card-text texto">Gerenciar Clientes</p>
                  </div>
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