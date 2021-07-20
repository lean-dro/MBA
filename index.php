<?php
include_once("conexao.php");
$sql = "select * from atividade;";
$consulta = mysqli_query($conexao, $sql);
?>
<html lang="pt-br">
<head>
    <title>MBA · Organização Web</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
    <body>
        <!--Container Principal-->
        <div class="row container-fluid mt-2">
            <!--Formulário-->
            <div class="col-sm-12 col-md-6 col-lg-3 alaFormsPrincipal">
                <h2 class="text-center">Insira as informações:</h2>
                    <form action="insere.php" method="POST">
                        <!--Materia-->
                        <label class="form-label mt-3">Matéria:</label><br>
                        <select class="form-select" name="slMat" id="slMat">
                            <option value="">Escolha</option>
                            <option value="BD">Banco de Dados</option>
                            <option value="BIO">Biologia</option>
                            <option value="DS">Desenvolvimento de Sistemas</option>
                            <option value="EF">Educação Física</option>
                            <option value="ECO">Ética</option>
                            <option value="FIS">Física</option>
                            <option value="GEO">Geografia</option>
                            <option value="HIST">História</option>
                            <option value="LEMI">Inglês</option>
                            <option value="LPL">Português</option>
                            <option value="MAT">Matemática</option>
                            <option value="PAM">Programação de Apps Mobile</option>
                            <option value="PW">Programação Web</option>
                            <option value="QUIM">Química</option>
                        </select>
                        <!--Desc att-->
                        <label class="form-label  mt-3">Descrição da atividade:</label><br>
                        <input class="form-control" type="text" id="txtDesc" name="txtDesc">
                        <!--Dt postagem-->
                        <label class="form-label  mt-3">Data da postagem:</label><br>
                        <input class="form-control" type="date" name="dtPostagem" id="dtPostagem">
                        <!--Dt entrega-->
                        <label class="form-label  mt-3">Data da entrega:</label><br>
                        <input class="form-control" type="date" name="dtEntrega" id="dtEntrega">
                        <!--Forma de entrega-->
                        <label class="form-label  mt-3">Forma de entrega:</label><br>
                        <select class="form-select" name="slEntreg" id="slEntreg">
                            <option value="Teams">Teams</option>
                            <option value="Avulsa">Avulsa</option>
                        </select>
                        <!--Link-->
                        <label class="form-label mt-3">Link de referência (Opcional):</label><br>
                        <input class="form-control" type="text" id="txtLink" name="txtLink">
                        <!--Status-->
                        <label class="form-label  mt-3">Situação:</label>
                        <select class="form-select" name="slSit" id="slSit">
                            <option value="Pendente">Pendente</option>
                            <option value="Entregue">Entregue</option>
                        </select>
                        <!--Botão de enviar-->
                        <input class="btn btn-primary mt-3 float-end mb-3" type="submit" value="Enviar">
                    </form>
            </div>
            <!--Coluna 2-->
            <div class="col-sm-12 col-md-12 col-lg-9 table-responsive">
                <!--Titulo-->
                <p class="text-white font-monospace fs-1 text-center">Atividades</p>
                <!--Tabela-->
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Matéria</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Atribuição</th>
                            <th scope="col">Entrega</th>
                            <th scope="col">Entrega</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($dado = $consulta->fetch_array()) { ?>
                            <tr>
                                <td scope="row"><?php echo $dado['id'] ?></td>
                                <td><?php echo $dado['materia'] ?></td>
                                <td><?php echo $dado['descricao'] ?></td>
                                <td><?php $data = $dado['dataPost'];
                                    $data = date_create($data);
                                    echo date_format($data, 'd/m') ?></td>
                                <td><?php $data = $dado['dataEntreg'];
                                    $data = date_create($data);
                                    echo date_format($data, 'd/m') ?></td>
                                <td><?php echo $dado['teams'] ?></td>
                                <td><?php
                                    $link = $dado['linkRef'];
                                    if ($link == "Nenhum") {
                                        echo $link;
                                    } else {
                                        echo "<a href='$link' target='_blank'>$link</a>";
                                    } ?></td>
                                    <?php
                                    $status = $dado['status'];
                                    $dataDif = date_diff(date_create(date('d-m-Y')), date_create($dado['dataEntreg']));
                                    $dias = (int) $dataDif->format('%r%a');
                                    if ($status == "Pendente") {
                                        if ($dias < 0) {
                                            echo "<td class='text-danger'>$status"." - Atrasada faz ".(-1*$dias)." dias";
                                        }else {
                                            echo "<td class='text-danger'>$status"." - Restam $dias dias";
                                        }
                                    } else {
                                        echo "<td class='text-success'>$status";
                                    } ?>
                                </td>

                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
                <!--consolezinho-->
                <div class=" col-sm-12 console">
                    <?php
                    if (isset($_COOKIE['resultado'])) {
                        echo "<p class='font-monospace'>Resultado: " . $_COOKIE['resultado'] . "</p>";
                    } else {
                        echo "<p class='font-monospace'>Resultado: </p>";
                    }
                    ?>
                </div>
                <!--Limpa tudo-->
                <a href="reset.php"><button type="submit" class="btn btn-danger mb-3">Limpar atividades</button></a>
                <!--Formulários de alterações-->
                <div class="row limitador" style="margin-left: 1px;">
                    <!--Formulário UPDATE-->
                    <div class="alaForms col-lg-3 col-sm-6 pb-3 rounded-0">
                        <form action="altera.php" method="POST">
                            <label class="form-label ">Insira o id:</label>
                            <input type="text" name="idAltera" id="idAltera" class="form-control">
                            <input type="submit" value="Concluir atividade" class="btn btn-success mt-1">
                        </form>
                    </div>
                    <!--Formulário DELETE-->
                    <div class="alaForms col-lg-3 col-sm-6 pb-3 rounded-0">
                        <form action="exclui.php" method="POST">
                            <label class="form-label ">Insira o id:</label>
                            <input type="text" name="idExclui" id="idExclui" class="form-control">
                            <input type="submit" value="Excluir atividade" class="btn btn-danger mt-1">
                        </form>
                    </div>
                </div>
                <img class="img-fluid logo mx-auto d-block" src="assets/logoMBA.png">
            </div>
        </div>
    </body>
</html>