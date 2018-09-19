<?php 
	
	class Usuario {
		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario() {
			return $this->idusuario;
		}

		public function setIdusuario($idusuario) {
			$this->idusuario = $idusuario;
		}

		public function getDeslogin() {
			return $this->deslogin;
		}

		public function setDeslogin($deslogin) {
			$this->deslogin = $deslogin;
		}

		public function getDessenha() {
			return $this->dessenha;
		}

		public function setDessenha($dessenha) {
			$this->dessenha = $dessenha;
		}

		public function getDtcadastro() {
			return $this->dtcadastro;
		}

		public function setDtcadastro($dtcadastro) {
			$this->dtcadastro = $dtcadastro;
		}

		public function getUsuarioById($id) {
			$sql = new Sql();
			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(
				":id" => $id
			));

			if(isset($results[0])) {
				$this->setData($results[0]);
			}
		}

		public static function getUsuariosByLogin($login) {
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :search ORDER BY deslogin", array(
					":search" => "%" . $login . "%"
				));
		}

		public function login($login, $senha) {
			$sql = new Sql();

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :login AND dessenha = :senha", array(
					":login" => $login,
					":senha" => $senha
			));

			if(isset($results[0])) {				
				$this->setData($results[0]);
			} else {
				throw new Exception("Login ou senha inválidos.");
			}
		}

		public static function getUsuarios() {
			$sql = new Sql();

			return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
		}

		public function setData($data) {
			$this->setIdusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			$this->setDtcadastro(new DateTime($data['dtcadastro']));
		}

		public function insert() {
			$sql = new Sql();

			$sql->select("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :SENHA)", array(
				':LOGIN' => $this->getDeslogin(),
				':SENHA' => $this->getDessenha()
			));

			$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = (SELECT MAX(idusuario) FROM tb_usuarios)");

			/*
			$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)" ,array(
					':LOGIN' => $this->getDeslogin(),
					':SENHA' => $this->getDessenha()
				));
			*/

			if(count($results) > 0) {
				$this->setData($results[0]);
			}
		}

		public function update($login, $senha) {

			$this->setDeslogin($login);
			$this->setDessenha($senha);

			$sql = new Sql();

			$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
				':LOGIN' => $this->getDeslogin(),
				':SENHA' => $this->getDessenha(),
				':ID' => $this->getIdusuario()
			));
		}

		public function __construct($login = "", $senha = "") {
			$this->setDeslogin($login);
			$this->setDessenha($senha);
		}

		public function __toString() {
			return json_encode(array(
				"idusuario" => $this->getIdusuario(),
				"deslogin" => $this->getDeslogin(),
				"dessenha" => $this->getDessenha(),
				"dtcadastro" => $this->getDtcadastro()->format("d/m/Y H:i:s")
			));
		}
	}

?>