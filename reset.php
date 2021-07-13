<?php 
    include_once("conexao.php");
    header("location: index.php");
    
    $truncar = "truncate table atividade;";
    mysqli_query($conexao, $truncar) or die (setcookie('resultado', $teste="Falha ao limpar", time()+1));
    setcookie('resultado', $teste="Dados limpos com sucesso", time()+1);
    mysqli_close($conexao);
?>