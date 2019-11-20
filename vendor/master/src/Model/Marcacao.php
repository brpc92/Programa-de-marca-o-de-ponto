<?php

namespace Master\model;
use Master\DB\Sql;

/**
 * 
 */
class Marcacao
{


	private $entrada;
	private $saidaAlmoco;
	private $voltaAlmoco;
	private $saida;
	private $data;
	private $idUser;
	
	
	


//GETTERS
	public function getEntrada(){

		return $this->entrada;
	}

	public function getSaidaAlmoco(){

		return $this->saidaAlmoco;
	}
	public function getVoltaAlmoco(){

		return $this->voltaAlmoco;
	}
	public function getSaida(){

		return $this->saida;
	}

	public function getData(){

		return $this->data;
	}

	
	//SETTERS
	public function setEntrada($entrada){

		$this->entrada = $entrada;

	}

	public function setSaidaAlmoco($saidaAlmoco){

		$this->saidaAlmoco = $saidaAlmoco;

	}

	public function setVoltaAlmoco($voltaAlmoco){

		$this->voltaAlmoco = $voltaAlmoco;

	}

	public function setSaida($saida){

		$this->saida = $saida;

	}

	public function setData($data){

		$this->data = $data;

	}


	public function insertEntrada(){
		$sql = new Sql();
		$sql->query("INSERT INTO tb_horas (entrada,data) VALUES (:entrada,:data)", 
			array(
		
			":entrada"=> $this->getEntrada(),
			":data"=> $this->getData()
					
		));
	}

	public function insertSaidaAlmoco(){
		$sql = new Sql();
		$sql->query("UPDATE tb_horas SET saida_almoco = :saidaAlmoco WHERE data=:data", 
			array(
		
			":saidaAlmoco"=> $this->getSaidaAlmoco(),
			":data"=> $this->getData()


					
		));
	}


	public function insertVoltaAlmoco(){
		$sql = new Sql();
		$sql->query("UPDATE tb_horas SET volta_almoco= :voltaAlmoco WHERE data=:data", 
			array(
		
			":voltaAlmoco"=> $this->getVoltaAlmoco(),
			":data"=> $this->getData()


					
		));
	}

	public function insertSaida(){
		$sql = new Sql();
		$sql->query("UPDATE tb_horas SET saida= :saida WHERE data=:data", 
			array(
		
			":saida"=> $this->getSaida(),
			":data"=> $this->getData()


					
		));
	}
	



public function listHoras(){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_horas WHERE data =:data", array(
			":data" => $this->getData()

		));
	if($result==true){

		$this->setEntrada($result[0]["entrada"]);
		$this->setSaidaAlmoco($result[0]["saida_almoco"]);
		$this->setVoltaAlmoco($result[0]["volta_almoco"]);
		$this->setSaida($result[0]["saida"]);


		return $result[0];

	}else{
		return $result=0;
	}

	}


public function listTotal(){
$sql = new Sql();
$result = $sql->select("select

addtime(

subtime(saida,volta_almoco),

	
    
 subtime(saida_almoco,entrada)
	
  )  
    
 as total_horas from tb_horas where data=:data; ",array(
		":data" => $this->getData()
));
if ($result==true){
	return $result[0];
}else{

	return $result=0;
}


}
}
?>