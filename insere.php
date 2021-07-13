<?php
    header("location: index.php");
    include_once("conexao.php");
    $materia = $_POST['slMat'];
    if ($materia==" ") {
        die(setcookie('resultado', $teste="Falha ao cadastrar.", time()+1));
    }else {
        $materia = $_POST['slMat'];
    }

    $desc = $_POST['txtDesc'];
    if ($desc==" ") {
        die(setcookie('resultado', $teste="Falha ao cadastrar.", time()+1));
    }else {
        $desc = $_POST['txtDesc'];
    }

    $dtPost = $_POST['dtPostagem'];
    $dtEntreg = $_POST ['dtEntrega'];

    $formaEntrega = $_POST['slEntreg'];
    $link = $_POST['txtLink'];
    if ($link==""){
        $link = "Nenhum";
    }else {
        $link = $_POST['txtLink'];
    }
    $status = $_POST['slSit'];


    echo $materia."<br>".$desc."<br>".$dtEntreg."<br>".$dtPost."<br>".$formaEntrega."<br>".$link."<br>".$status;

    $insertTabela = "Insert into atividade values";
    $insertTabela .= "(default,'$materia','$desc','$dtPost','$dtEntreg','$formaEntrega','$link','$status');"; 
    mysqli_query($conexao, $insertTabela) or die (setcookie('resultado', $teste="Falha ao cadastrar.", time()+1));
    setcookie('resultado', $teste="Cadastro realizado com sucesso.", time()+1);
    mysqli_close($conexao);
?>