<?php 
    include_once("conexao.php");
    header("location: index.php");
    
    $id = $_POST['idExclui'];
    $delete = "delete from atividade where id = '$id'";
    mysqli_query($conexao, $delete) or die (setcookie('resultado', $teste="Falha ao remover atividade", time()+1));
    $teste="Atividade removida com sucesso";
    setcookie('resultado', $teste="Atividade removida com sucesso", time()+1);
    mysqli_close($conexao);
?>