<?php
require 'slim/Slim.php';

\slim\Slim::registerAutoloader();

$app = new \slim\Slim();

$app->get('/:controller/:action(/:parameter)', function($controller, $action, $parameter = null) {
	include_once "cls/{$controller}.php";
	$classe = new $controller();
	$chamada = call_user_func_array(array($classe, $action), array($parameter));
	
	echo "{'resultado':" . json_encode($chamada) . "}";
});

$app->run();