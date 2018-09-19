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
	$usuario = new Usuario();
	$usuario->login("guilherme", "1234mudar");

	echo $usuario;
?>