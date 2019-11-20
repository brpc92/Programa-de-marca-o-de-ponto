<?php
session_start();
require_once("vendor".DIRECTORY_SEPARATOR."autoload.php");
use Master\Template;
use Slim\Slim;
use Master\Model\User;
use Master\Model\Marcacao;



//obj do Slim para gerenciar as rotas
$app = new Slim();
$app->config('debug', true);

$app->get('/', function(){
	header("Location: /admin/login");
	exit();

});
//LOGIN
$app->get('/admin/login', function(){
	if(isset($_SESSION["USER"])){
		if((int)$_SESSION["USER"]["id_users"] > 0){
			header("Location: /admin/starter");
			exit();
		}
	}
	$tpl = new Template(false);
	$tpl->setTemplate("login"
	,['error'=>User::getError()]
	);

});
$app->post('/admin/login', function(){
	try {
		$user = new User();
	$user->logar($_POST["login"], $_POST["senha"]);

	header("Location: /admin/starter/marcacao");
	exit();
	} catch (Exception $e) {
		User::setError($e->getMessage());
		$tpl = new Template();
		$tpl->setTemplate("login"
	,['error'=>User::getError()]
	);
	}

});
//USER
//tela principal
$app->get('/admin/starter',function(){


	User::verifyLogin();
	$result = User::listAll();
	$tpl = new Template();
	$tpl->setTemplate("starter",array(
		"user" => $_SESSION["USER"],
		"users" => $result
	));
});
//USER
//pesquisa
$app->post('/admin/starter',function(){
	User::verifyLogin();
	$pesquisa = $_POST["pesquisa"];
	$user = new User();
	$userpesquisado = $user->listSearch($pesquisa);
	$tpl = new Template();
	$tpl->setTemplate("starter", array(
		"user" => $_SESSION["USER"],
		"users" => $userpesquisado
	));

//USER
//logof
});
$app->get('/admin/logout', function(){
	User::logout();
	header("Location: /admin/login");
	exit();

});
//USER
//pagina criar
$app->get('/admin/starter/create',function(){
	User::verifyLogin();

	$mensagem=false;
	$tpl = new Template();
	$tpl->setTemplate("users-create", array(
		"users" => $_SESSION["USER"],
		"mensagem" =>$mensagem
	));
});

//USER
//methodo para criar
$app->post('/admin/starter/create', function(){
	User::verifyLogin();
	$user = new User();
	$pesquisa=$_POST["login"];

	$retorno=$user->listSearchLogin($pesquisa);

	if($retorno==true){
	$mensagem=true;
	$tpl = new Template();
	$tpl->setTemplate("users-create", array(
		"users" => $_SESSION["USER"],
		"mensagem" =>$mensagem
	));


	}else{

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;
	$user->setName($_POST["name"]);
	$user->setLogin($_POST["login"]);
	$user->setPassword($_POST["password"]);
	$user->setEmail($_POST["email"]);
	$user->setAdmin($_POST["inadmin"]);
	$user->insert();
	header("Location: /admin/starter");
	exit();
}
});


//USER
//methodo para deletar
$app->get('/admin/starter/delete/:id', function($id){
	User::verifyLogin();
	$user = new User();
	$user->setIdUser($id);
	$user->delete();
	header("Location: /admin/starter");
	exit();
});
//USER
//abrir pagina para atualizar
$app->get('/admin/starter/update/:id', function($id){
	User::verifyLogin();
	$user = new User();
	$user->setIdUser($id);
	$mensagem=false;
	$userById = $user->loadById();
	$tpl = new Template();
	$tpl->setTemplate("users-update", array(
		"users" => $userById,
		"mensagem"=>$mensagem,
		"user" => $_SESSION["USER"]
	));
});
//USER
//methodo para atualizar
$app->post('/admin/starter/update/:id', function($id){
	User::verifyLogin();
	$user = new User();

	$pesquisa=$_POST["login"];
	$espelho=$_POST["espelho"];

	if($pesquisa!=$espelho){

		$retorno=$user->listSearchLogin($pesquisa);

		if($retorno==true){

	$user->setIdUser($id);
	$mensagem=true;
	$userById = $user->loadById();
		$tpl = new Template();
	$tpl->setTemplate("users-update", array(
		"users" => $userById,
		"mensagem"=>$mensagem,
		"user" => $_SESSION["USER"]
	));

		}
		else{
		$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;
	$user->setName($_POST["name"]);
	$user->setLogin($_POST["login"]);
	$user->setEmail($_POST["email"]);
	$user->setAdmin($_POST["inadmin"]);
	$user->setIdUser($id);
	$user->update();
	header("Location: /admin/starter");
	exit();

	}

	}else{
		$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;
	$user->setName($_POST["name"]);
	$user->setLogin($_POST["login"]);
	$user->setEmail($_POST["email"]);
	$user->setAdmin($_POST["inadmin"]);
	$user->setIdUser($id);
	$user->update();
	header("Location: /admin/starter");
	exit();

	}


});

//MARCAÇÃO


//
//tela principal
$app->get('/admin/starter/marcacao', function(){

	$user=User::verifyLogin();
	$marca= new Marcacao();

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y');	

	$marca->setData($data); 
	$result=$marca->listHoras();
	$total=$marca->listTotal();

	$tpl = new Template;
	$tpl->setTemplate("starter-marcacao",array(
		"user" => $_SESSION["USER"],
		"data"=>$data,
		"horas"=>$result,
		"total"=>$total



	));
	
});

//entrada
$app->get('/admin/hora/entrada', function(){
	User::verifyLogin();
	$marca= new Marcacao();

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y');	
	
	date_default_timezone_set('America/Sao_Paulo');
	$getHora=date("H:i:s");

	$marca->setEntrada($getHora);
	$marca->setData($data);	
	$marca->insertEntrada();
	
	header("Location: /admin/starter/marcacao");
	exit();
	
});

//saida almoço

$app->get('/admin/hora/saida_almoco', function(){
	User::verifyLogin();
	$marca= new Marcacao();
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y');
	$getHora=date("H:i:s");
	
	$marca->setSaidaAlmoco($getHora);
	$marca->setData($data);	

	$marca->insertSaidaAlmoco();
	header("Location: /admin/starter/marcacao");
	exit();
	
	
});

//Retorno Almoço

$app->get('/admin/hora/retorno_almoco', function(){
	User::verifyLogin();
	$marca= new Marcacao();
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y');
	$getHora=date("H:i:s");
	
	$marca->setVoltaAlmoco($getHora);
	$marca->setData($data);	

	$marca->insertVoltaAlmoco();
	header("Location: /admin/starter/marcacao");
	exit();
	
	
});

$app->get('/admin/hora/saida', function(){
	User::verifyLogin();
	$marca= new Marcacao();
	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y');
	$getHora=date("H:i:s");
	
	$marca->setSaida($getHora);
	$marca->setData($data);	

	$marca->insertSaida();
	header("Location: /admin/starter/marcacao");
	exit();
	
	
});






//verifi

if(isset($_GET['saidaAlmoco'])){
	$marca->setSaidaAlmoco($getHora);
	$marca->setData($data);		
	$marca->insertSaidaAlmoco();

			$tpl = new Template;
	$tpl->setTemplate("starter-marcacao",array(
		"user" => $_SESSION["USER"],
		"data"=>$data
		
	));
	}

	if(isset($_GET['voltaAlmoco'])){
	$marca->setVoltaAlmoco($getHora);
	
	$marca->insertVoltaAlmoco();
			$tpl = new Template;
	$tpl->setTemplate("starter-marcacao",array(
		"user" => $_SESSION["USER"],
		"data"=>$data
		
	));
	}

	if(isset($_GET['saida'])){
	$marca->setSaida($getHora);
	
	$marca->insertSaida();
			$tpl = new Template;
	$tpl->setTemplate("starter-marcacao",array(
		"user" => $_SESSION["USER"],
		"data"=>$data
		
	));
	}



$app->run();
?>