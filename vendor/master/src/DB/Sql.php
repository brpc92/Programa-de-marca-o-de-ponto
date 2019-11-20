<?php

namespace Master\DB;
class Sql{

	const LOCAL = "localhost";
	const NAME = "dbponto";
	const PASS = "";
	const USER = "root";

	private $conn;

	public function __construct(){

		//toda vez que chamada a classe, já é criada a conexão

		$this->conn = new \PDO("mysql:dbname=".Sql::NAME.";host=".Sql::LOCAL, Sql::USER, Sql::PASS);

	}
	public function params($statement, $param = array()){

		foreach ($param as $key => $value) {
			$this->bindParamAuto($statement, $key, $value);
		}

	}

	private function bindParamAuto($stmt, $key, $value){

		$stmt->bindParam($key, $value);

	}

	//Metodo para query sem parametros
	public function queryWithoutParam($query){
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	}

	//Metodo para query com parametros
	public function query($query, $param = array()){
		$stmt = $this->conn->prepare($query);
		$this->params($stmt, $param);
		
		$stmt->execute();
	}

	public function select($querys, $param = array()){
		$stmt = $this->conn->prepare($querys);
		$this->params($stmt, $param);
		$stmt->execute();

		//retorna todos os resultados do select em um array
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

}

?>