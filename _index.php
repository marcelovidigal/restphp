<?php
require 'slim/Slim.php';

\slim\Slim::registerAutoloader();

$app = new \slim\Slim(array('debug'=>false));

$app->error(function(Exception $e) use ($app) {
	$erro = new stdClass();
	$erro->message = $e->getMessage();
	//$erro->trace = $e->getTraceAsString();
	$erro->file = $e->getFile();
	$erro->line = $e->getLine();
	
	echo "{'erro':" . json_encode($erro) . "}";
});

$app->get('/:controller/:action(/:parameter)', function($controller, $action, $parameter = null) {
	include_once "cls/{$controller}.php";
	$classe = new $controller();
	$retorno = call_user_func_array(array($classe, $action), array($parameter));
	
	echo "{'resultado':" . json_encode($retorno) . "}";
});

$app->run();