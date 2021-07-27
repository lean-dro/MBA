<?php
    header('location: index.php');
    include_once("conexao.php");
    
    $id = $_POST['idAltera'];
    $update = "update atividade set status='Entregue' where id='$id';";
    mysqli_query($conexao, $update) or die (setcookie('resultado', $teste="Sem sucesso ao atualizar.", time()+1));
    setcookie('resultado', $teste="Atividade atualizada.", time()+1);
    mysqli_close($conexao);
?>

