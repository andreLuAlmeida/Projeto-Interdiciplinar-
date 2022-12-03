<?php
//CONECTA AO BANCO DE DADOS
require_once 'classeUser.php';
$p = new Pessoa("rede-social", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - tela de login</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<h2>Social Academy</h2>
<?php

//CADASTRA O USUARIO
if(isset($_POST['nome']))
{
	$nome =  addslashes($_POST['nome']);
	$usuario = addslashes($_POST['usuario']);
	$email = addslashes($_POST['email']);
	$numero = addslashes($_POST['numero']);
	$senha = addslashes($_POST['senha']);
	$funcao = addslashes($_POST['disdos']);
	$p->cadastrarPessoa($nome, $usuario, $email, $numero, $senha, $funcao);	
}
?>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form method="POST">
			<h1>Criar Conta</h1>
			<span>ou use seu e-mail para se registrar</span>
			<input type="text" placeholder="Nome"  name="nome"/>
      		<input type="text" placeholder="Usuário" name="usuario" />
			<input type="email" placeholder="E-mail" name="email"/>
      		<input type="number" placeholder="Número" name="numero"/>
			<input type="password" placeholder="Senha" name="senha"/>
			<select id="disdos" name="disdos">
				<option value="Discente">Discente</option>
				<option value="Docente">Docente</option>
			</select>
			<button type = "submit">Registrar-se</button>
		</form>
	</div>
	

	<div class="form-container sign-in-container">
		<form action="logar.php" method="POST">
			
			<h1>Login</h1>
			<span>ou use sua conta</span>
			<input type="email" placeholder="E-mail" name = "imal"/>
			<input type="password" placeholder="Senha" name = "sinha"/>
			<a href="#">Esqueceu sua senha?</a>
			<button type="submit" name="login">Entrar</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Bem vindo de volta!</h1>
				<p>Para conectar-se novamente, faça o login com suas informações.</p>
				<button class="ghost" id="signIn">Entrar</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Olá, seja bem vindo!</h1>
				<p>Coloque os seus dados pessoais e comece a navegar conosco.</p>
				<button class="ghost" id="signUp">Registrar-se</button>
			</div>
		</div>
	</div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>