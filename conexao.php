<?php
	$username='root';
	$password='';
	$servername='localhost'; 
	$database='ajudaestudo';
	$conexao = mysqli_connect($servername, $username, $password, $database);
	if (!$conexao) {
		die ("Num deu bom :(". mysqli_connect_error());
	}
?>