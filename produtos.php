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

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
$dataLocal = date('d/m/Y');
$horaLocal = date('H:i:s', time());


//Pesquisa de Livros
$sqlLivros = "SELECT l.codigo, c.categoria, l.titulo, l.autor, l.preco, l.imagem, l.qtde FROM livros as l inner join categorias as c on l.categoria = c.codigo order by codigo ASC";
$resultado = $mysqli->query($sqlLivros);


//Pesquisa de Categoria
$sqlCategoria = "SELECT * FROM categorias";
$resultadoCat = $mysqli->query($sqlCategoria);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Livraria do Italo</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/estilo.css" />
        <script language="Javascript">
            function confirmacao(id) {
                var resposta = confirm("Deseja remover esse registro?");

                if (resposta == true) {
                    window.location.href = "deletaLivro.php?id=" + id;
                }
            }
        </script>
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
                                <center><h6><?php echo $dataLocal; ?> <br> <?php echo $horaLocal; ?></h6><br><a href="admin.php">Voltar</a></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <section class="row">
                <h1 class="alert alert-success col-lg-12" style="text-align: center;">Lista de Produtos</h1>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="button" class="btn btn-primary btn-lg" style="position: relative; float: right;" data-toggle="modal" data-target="#myModal">Cadastrar Livro</button>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cadastrar Livro</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="cadLivros.php" method="POST" enctype="multipart/form-data">
                                                <fieldset>

                                                    <!-- Form Name -->
                                                    <legend>Preencha os dados do novo produto!</legend>

                                                    <!-- Text input-->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="titulo">Titulo</label>  
                                                        <div class="col-md-5">
                                                            <input id="titulo" name="titulo" type="text" placeholder="Titulo do Livro" class="form-control input-md" required="">
                                                            <span class="help-block">Ex: Como vender meu Livro!</span>  
                                                        </div>
                                                    </div>

                                                    <!-- Text input-->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="autor">Autor</label>  
                                                        <div class="col-md-5">
                                                            <input id="autor" name="autor" type="text" placeholder="Autor do Livro" class="form-control input-md" required="">
                                                            <span class="help-block">Ex: Monteiro Lobato</span>  
                                                        </div>
                                                    </div>

                                                    <!-- Select Basic -->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="categoria">Categoria</label>
                                                        <div class="col-md-5">
                                                            <select id="categoria" name="categoria" class="form-control">
                                                                <option value="">Selecione...</option>
                                                                <?php
                                                                while ($cat = $resultadoCat->fetch_assoc()) {
                                                                    $codCat = $cat['codigo'];
                                                                    $nomeCat = $cat['categoria'];
                                                                    ?>
                                                                    <option value="<?php echo $codCat; ?>"><?php echo $nomeCat; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Text input-->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="preco">Preço</label>  
                                                        <div class="col-md-4">
                                                            <input id="preco" name="preco" type="text" placeholder="Preço do Livro" class="form-control input-md" required="">
                                                            <span class="help-block">Ex: R$20.00</span>  
                                                        </div>
                                                    </div>

                                                    <!-- Text input-->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="quantidade">Quantidade</label>  
                                                        <div class="col-md-4">
                                                            <input id="quantidade" name="quantidade" type="number" placeholder="Quantidade em Estoque" class="form-control input-md" required="">
                                                            <span class="help-block">Ex: 50</span>  
                                                        </div>
                                                    </div>

                                                    <!-- File Button --> 
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="img">Imagem</label>
                                                        <div class="col-md-4">
                                                            <input id="img" name="img" class="input-file" type="file">
                                                        </div>
                                                    </div>

                                                    <!-- Button -->
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label" for="btn_enviar"></label>
                                                        <div class="col-md-4">
                                                            <button id="btn_enviar"  class="btn btn-success">Cadastrar</button>
                                                        </div>
                                                    </div>

                                                </fieldset>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th><center>Cod.</center></th>
                                <th><center>Titulo</center></th>
                                <th><center>Autor</center></th>
                                <th><center>Categoria</center></th>
                                <th><center>Preço</center></th>
                                <th><center>Quantidade</center></th>
                                <th><center>Imagem</center></th>
                                <th><center>Editar</center></th>
                                <th><center>Excluir</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($dados = $resultado->fetch_assoc()) {
                                        $cod = $dados['codigo'];
                                        $titulo = $dados['titulo'];
                                        $categoria = $dados['categoria'];
                                        $autor = $dados['autor'];
                                        $imagem = $dados['imagem'];
                                        $preco = $dados['preco'];
                                        $quant = $dados['qtde'];
                                        ?>
                                        <tr>
                                            <td scope="row"><h4><?php echo $cod; ?></h4></td>
                                            <td><h4><?php echo $titulo; ?></h4></td>
                                            <td><h4><?php echo $autor; ?></h4></td>
                                            <td><h4><?php echo $categoria; ?></h4></td>
                                            <td><h4>R$<?php echo $preco; ?></h4></td>
                                            <td><h4><?php echo $quant; ?></h4></td>
                                            <td><center><img src="<?php echo $imagem; ?>" width="70%"/></center></td>
                                    <td><h4><a href="#?cod=<?php echo $cod; ?>">Editar</a></h4></td>
                                    <td><h4><a href="javascript:func()" onclick="confirmacao('<?php echo $cod; ?>')">Excluir</a></h4></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="row footer">
                <div class="col-lg-12 estilo-footer">
                    <center><h1>@Livrariadoitalo</h1></center>
                </div>
            </footer>

        </div>




        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="js/jquery-3.1.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>