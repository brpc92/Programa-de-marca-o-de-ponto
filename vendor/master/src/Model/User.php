<?php
namespace Master\Model;
use Master\DB\Sql;
 class User{
	/*
	id_users int(11) AI PK 
	name varchar(120) 
	login varchar(50) 
	password varchar(45) 
	email varchar(150) 
	inadmin
	*/
	private $iduser;
	
	private $login;
	private $password;
	
	private $admin;
	private $error;

	const ERROR="UserError";
	
	//GETTERS

	public function getIdUser(){

		return $this->iduser;
	}
	public function getName(){

		return $this->name;
	}
	public function getLogin(){

		return $this->login;
	}
	public function getPassword(){

		return $this->password;
	}
	public function getEmail(){

		return $this->email;
	}
	public function getAdmin(){

		return $this->admin;
	}

	//SETTERS
	public function setMessage($error){
		$this->error=$error;

	}
	public function setIdUser($iduser){

		$this->iduser = $iduser;

	}
	public function setName($name){

		$this->name = $name;

	}
	public function setLogin($login){

		$this->login = $login;

	}
	public function setPassword($pass){

		$this->password = $pass;

	}
	public function setEmail($email){

		$this->email = $email;

	}
	public function setAdmin($inadmin){

		$this->admin = $inadmin;

	}
	//NEGOCIOS

	public function logar($login, $senha){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_users WHERE login = :login AND password = md5(:senha)", array(
			":login" => $login,
			":senha" => $senha
		));
		if(count($results) == 0){
			throw new \Exception("Usuário ou Senha incorretos");
			

		}else{

			$this->setIdUser($results[0]["id_users"]);
			$this->setName($results[0]["name"]);
			$this->setLogin($results[0]["login"]);
			$this->setPassword($senha);
			$this->setEmail($results[0]["email"]);
			$this->setAdmin($results[0]["inadmin"]);
			$get = $results[0];

			$_SESSION["USER"] = $get;

		}

	}

	public static function verifyLogin(){
		if(!isset($_SESSION["USER"]) || !$_SESSION["USER"] 
			|| !(int)$_SESSION["USER"]["id_users"] > 0){
			header("Location: /admin/login");
			exit();
		}
	}

	public static function logout(){
		$_SESSION["USER"] = null;
	}

	public static function listAll(){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_users ORDER BY name");
		return $results;

	}
	public function listSearch($pesquisa){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_users WHERE name LIKE '%".$pesquisa."%' ORDER BY name");
		return $results;
	}
	public function listSearchLogin($pesquisa){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_users WHERE login LIKE '%".$pesquisa."%'");
		return $results;
	}

	public function insert(){

		$sql = new Sql();
		$sql->query("INSERT INTO tb_users (name, login, email, password, inadmin) VALUES (:name, :login, :email, md5(:pass), :inadmin)", 
			array(
			":name" => $this->getName(),
			":login" => $this->getLogin(),
			":email" => $this->getEmail(),
			":pass" => $this->getPassword(),
			":inadmin" => $this->getAdmin()
		));
	}

	public function delete(){
		$sql = new Sql();
		$sql->query("DELETE FROM tb_users WHERE id_users = :id_user",
			array(
			":id_user" => $this->getIdUser()
		));
	}

	public function loadById(){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_users WHERE id_users = :id", array(
			":id" => $this->getIdUser()
		));
		$this->setIdUser($result[0]["id_users"]);
		$this->setName($result[0]["name"]);
		$this->setLogin($result[0]["login"]);
		$this->setPassword($result[0]["password"]);
		$this->setEmail($result[0]["email"]);
		$this->setAdmin($result[0]["inadmin"]);
		return $result[0];
	}

	public function update(){
		$sql = new Sql();
		$sql->query("UPDATE tb_users SET name = :name, login = :login, email = :email, inadmin = :inadmin WHERE id_users = :id", array(
			":name"=> $this->getName(),
			":login"=> $this->getLogin(),
			":email" => $this->getEmail(),
			":inadmin" => $this->getAdmin(),
			":id" => $this->getIdUser()
		));
	}
/*
		public function getMessage(){
		//$error="Usuário ou senha incorretos";
			return $this->error;		
	}
	
*/
	public static function setError($msg){

		$_SESSION[User::ERROR]=$msg;

	}

	public static function getError(){

		$msg=(isset($_SESSION[User::ERROR])&& $_SESSION[User::ERROR])? $_SESSION[User::ERROR]:'';
			User::clearError();
			return $msg;
	}
	
	public static function clearError(){

		$_SESSION[User::ERROR]=NULL;
	}		

	
		
}



?>