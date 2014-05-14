<?php
require 'slim/Slim.php';

\slim\Slim::registerAutoloader();

$app = new \slim\Slim();

$app->get('/:controller/:action(/:parameter)', function($controller, $action, $parameter = null) {
	echo "Controle: $controller<br />";
	echo "Acao: $action<br />";
	echo "Parametro: $parameter<br />";
});

$app->run();