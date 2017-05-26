<?php  

    session_start();
    if(isset($_SESSION['logado'])){
        if($_SESSION['adm'] == TRUE){
            $nome = $_SESSION['nome'];
        }
        else{
            $nome = $_SESSION['nome'];
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
    require_once("conecta_mysql.inc.php");

    $sqlBuscaLivros = "SELECT l.titulo, c.categoria, l.autor, l.preco,l.qtde,l.codigo,l.imagem FROM livros as l inner join categorias as c on l.categoria = c.codigo order by codigo ASC";

    $resultado = $mysqli -> query($sqlBuscaLivros);
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
                <div class="jumbotron jumbotron-fluid col-lg-12 estilo-header">
                  <div class="container">
                    <div class="row">
                        <div class="col-lg-10">
                            <center>
                                <h1 class="display-1">Livraria do Italo</h1>
                                <p class="lead">Aqui voce encontra os Melhores Livros pelos menores preços!</p>
                           </center>
                        </div>

                        <div class="col-lg-2">
                            <center><a href="logout.php" style="color: #fff; text-decoration: none;"> <img src="imagens/logout.ico" alt="Sair" width="70%"> </a></center>
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
                <h1 class="col-lg-12 alert alert-success" style="text-align: center;">
                    Livros Mais Vendidos
                </h1>
            </div>
            
            

            <div class="row">
                        <?php
                            while ($dados = $resultado->fetch_assoc()) {
                                $titulo = $dados['titulo'];
                                $categoria = $dados['categoria'];
                                $autor = $dados['autor'];
                                $imagem = $dados['imagem'];
                                $preco = $dados['preco'];
                                $quant = $dados['qtde'];
                        ?>
                            <div class="card col-lg-3" style="margin-top: 1%; margin-right: 4%; margin-left: 4%; margin-bottom: 4%; border: 2px solid #888; padding-top: 1%; border-radius: 0px 0px 50px 50px; background: -moz-linear-gradient(top, #7abcff 0%, #60abf8 44%, #4096ee 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, #7abcff 0%,#60abf8 44%,#4096ee 100%); color: #fff; box-shadow: 2px 5px 10px rgba(0,0,0,0.7);">

                              <img style="height: 404px; border-radius: 50px; border: 2px #fff solid;" class="card-img-top" src="<?php echo $imagem; ?>" alt="Card image cap">
                              <div class="card-block">
                                <hr style="background: #fff;">
                                <h4 class="card-title"><?php echo $titulo; ?> - <small><?php echo $autor; ?></small></h4>
                                <hr style="background: #fff;">
                                <p class="card-text">Categoria: <?php echo $categoria; ?></p>
                                <p class="card-text"><strong>Preço: R$<?php echo $preco; ?></strong></p>
                                <p class="card-text"><label class="badge badge-success">Quantidade:</label> <?php echo $quant; ?> Livros</p>
                                <hr style="background: #fff;">
                                <center><button class="btn btn-success" type="submit">Comprar</button></center>
                              </div>
                            </div>

                        <?php
                            }
                        ?>
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