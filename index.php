<?php 
	require_once("config.php");

	// Carrega um usuaário
	//$usuario = new Usuario();
	//$usuario->getUsuarioById(18);

	// Lista usuários
	//$usuarios = Usuario::getUsuarios();

	// Carrega uma lista de usuários buscando pelo login
	//$usuarios = Usuario::getUsuariosByLogin("gui");

	// Carrega um usuário usando o login e a senha
	//$usuario = new Usuario();
	//$usuario->login("guilherme", "1234mudar");

	// Insere aluno novo
	//$aluno = new Usuario("aluno", "@lun0");

	//$aluno->insert();

	// Atualizando usuário
	$aluno = new Usuario();
	$aluno->getUsuarioById(40);
	$aluno->update("jetao", "fon123");


	echo $aluno;
?>