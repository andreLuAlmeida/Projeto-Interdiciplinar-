<?php

Class Pessoa{
	private  $pdo;

	public function __construct($dbname, $host, $user, $senha) {

		try{
			$this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
		}
		catch(PDOException $e){
			echo "Erro com banco de dados: " . $e->getMessage();
			exit();
		}
		catch(Exception $e){
			echo "Erro generico: " . $e->getMessage();
			exit();
		}
		
	}

	public function buscarDados()
	{
		$res = array();
		$cmd = $this->pdo -> query("SELECT * FROM users ORDER BY nome");
		$res = $cmd->fetchAll();
		return $res;
	}

	//CADASTRA PESSOAS NO BANCO DE DADOS
	public function cadastrarPessoa($nome, $username, $email, $numero, $senha, $funcao)
	{
		//verificar se ja foi cadastrado
		$cmd = $this->pdo->prepare("SELECT id FROM users WHERE email = :e");
		$cmd->bindValue(":e", $email);
		$cmd->execute();
		if($cmd->rowCount() > 0)
		{
			return false;
		} else
		{
			$cmd = $this->pdo->prepare("INSERT INTO users (nome, username, email, pass, telefone, funcao) VALUES (:n, :u, :e, :nu, :s, :f)");
			$cmd->bindValue(":n", $nome);
			$cmd->bindValue(":u", $username);
			$cmd->bindValue(":e", $email);
			$cmd->bindValue(":nu", $senha);
			$cmd->bindValue(":s", $numero);
			$cmd->bindValue(":f", $funcao);
			$cmd->execute();
			return true;
		}
	}

	public function login($login, $senha)
	{
		$cmd = $this->pdo->prepare("SELECT * FROM users WHERE email = :email AND pass = :pass");
		$cmd->bindValue("email", $login);
		$cmd->bindValue("pass", $senha);
		$cmd->execute();

		if($cmd->rowCount()>0){
			$dado = $cmd->fetch();

			$_SESSION['idUser'] = $dado['id'];

			return true;
		}else{
			return false;
		}
	}
}
?>