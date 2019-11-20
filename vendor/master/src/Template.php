<?php
namespace Master;
use Rain\Tpl; 

	
class Template{

	private $tpl;
	public $foot;	

	//Configs da classe, setando diretorios
	public function __construct($footer = true, $view = "/views/"){
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$view,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
		   );

		Tpl::configure( $config );

		$this->tpl = new Tpl;		
		$this->foot = $footer;

	}

	public function __destruct(){
		if ($this->foot === true) {
			$this->tpl->draw("footer");
		}
	}


	//Seta o template da classe
	public function setTemplate($html, $variables = array(), $returnHTML = false){

		/*Percorre o array das variaveis que serão usadas no template
		* substituindo sua chave que será usada no html
		* pelo seu valor respectivo*/
		foreach ($variables as $key => $value) {
		
			$this->tpl->assign($key, $value);

		}
		
		//cria o template chamando o arquivo html
		return $this->tpl->draw($html, $returnHTML);
	}

}

?>