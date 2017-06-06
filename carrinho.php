<?php
error_reporting(0);
// inicia a sessão
session_start();

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

$cod = $_REQUEST['cod'];
$quant = $_REQUEST['quant'];
$titulo = $_REQUEST['titulo'];
$autor = $_REQUEST['autor'];
$imagem = $_REQUEST['img'];
$preco = $_REQUEST['preco'];


// verifica se ja existe a sessão carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION[carrinho] = array();
}

// adiciona o produto ao carrinho
if (!isset($_SESSION['carrinho'][$cod])) {
    $_SESSION['carrinho'][$cod]['quantidade'] = $quant;
    $_SESSION['carrinho'][$cod]['codigo'] = $cod;
    $_SESSION['carrinho'][$cod]['titulo'] = $titulo;
    $_SESSION['carrinho'][$cod]['autor'] = $autor;
    $_SESSION['carrinho'][$cod]['imagem'] = $imagem;
    $_SESSION['carrinho'][$cod]['preco'] = $preco;
} else {
    $_SESSION['carrinho'][$cod]['quantidade'] += $quant;
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livraria do Italo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilo2.css">
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


                    </div>
                </div>
            </div>

            <div class="row">
                <table class="table table-striped col-12">
                    <thead>
                        <tr>
                            <th><center></center></th>
                            <th><center>Titulo</center></th>
                            <th><center>Autor</center></th>
                            <th><center>Preço</center></th>
                            <th><center>Quantidade</center></th>
                            <th><center>Sub-Total</center></th>
                
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION[carrinho] as $cod => $quant){
                            $codC = $_SESSION['carrinho'][$cod]['codigo'];
                            $tituloC = $_SESSION['carrinho'][$cod]['titulo'];
                            $autorC = $_SESSION['carrinho'][$cod]['autor'];
                            $imagemC = $_SESSION['carrinho'][$cod]['imagem'];
                            $precoC = $_SESSION['carrinho'][$cod]['preco'];
                            $quantC = $_SESSION['carrinho'][$cod]['quantidade'];
                            $subC = number_format($precoC * $quantC, 2, ',','.');
                            $total += $subC;
                            ?>

                            <tr>
                                <th><center><img class="img-loja" src="<?php echo $imagemC; ?>" alt="<?php echo $tituloC; ?>" title="<?php echo $tituloC; ?>" /></center></th>
                        <td scope="row"><center><h4><?php echo $tituloC; ?></h4></center></td>
                        <td><center><h4><?php echo $autorC; ?></h4></center></td>
                        <td><center><h4>R$<?php echo $precoC; ?></h4></center></td>
                        <td><center><h4><?php echo $quantC; ?></h4></center></td>
                        <td><center><h4>R$ <?php echo $subC; ?> </h4></center></td>
                        </tr>
                        


                        <?php
                    }
                    ?>
                        <tr>
                            <td colspan="5" style="text-align: right;"><h4>Total</h4></td>
                            <td><center><h4>R$<?php echo $totalC = number_format($total, 2, ',','.'); ?></h4></center></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
            
            <div class="row">
                <a href="loja.php" class="col-lg-4"><button class="btn btn-warning" style="cursor: pointer;">Continuar Comprando</button></a>
                <a href="#" class="col-lg-4"><button class="btn btn-success" style="cursor: pointer;">Finalizar Compra</button></a>
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